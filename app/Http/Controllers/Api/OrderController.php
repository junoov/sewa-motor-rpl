<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Motor;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validMethods = ['bca', 'bri', 'mandiri', 'bni', 'gopay', 'ovo', 'dana', 'qris'];

        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'motor_id' => ['required_without:motor_slug', 'exists:motors,id'],
            'motor_slug' => ['required_without:motor_id', 'exists:motors,slug'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'pickup_location_id' => ['required', 'exists:locations,id'],
            'payment_method' => ['required', Rule::in($validMethods)],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $motor = Motor::query()
            ->when($data['motor_id'] ?? null, fn ($query, $id) => $query->where('id', $id))
            ->when($data['motor_slug'] ?? null, fn ($query, $slug) => $query->where('slug', $slug))
            ->firstOrFail();

        $start = Carbon::parse($data['start_date'])->startOfDay();
        $end = Carbon::parse($data['end_date'])->startOfDay();
        $durationDays = max(1, $start->diffInDays($end));
        $subtotal = $durationDays * $motor->price_per_day;
        $serviceFee = 10000;
        $total = $subtotal + $serviceFee;

        $booking = Booking::create([
            'order_number' => 'MR-'.now()->format('Ymd').'-'.Str::upper(Str::random(5)),
            'user_id' => $data['user_id'],
            'motor_id' => $motor->id,
            'pickup_location_id' => $data['pickup_location_id'],
            'start_date' => $start,
            'end_date' => $end,
            'duration_days' => $durationDays,
            'subtotal' => $subtotal,
            'deposit_amount' => $serviceFee,
            'total_price' => $total,
            'notes' => $data['notes'] ?? null,
            'terms_accepted_at' => now(),
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'method' => $data['payment_method'],
            'amount' => $total,
            'expires_at' => now()->addHours(2),
        ]);

        $booking->load(['motor.brand', 'pickupLocation']);

        return response()->json([
            'message' => 'Order berhasil dibuat.',
            'data' => [
                'order_number' => $booking->order_number,
                'user_id' => $booking->user_id,
                'motor' => [
                    'id' => $booking->motor->id,
                    'name' => $booking->motor->name,
                    'brand' => $booking->motor->brand->name,
                    'price_per_day' => $booking->motor->price_per_day,
                ],
                'pickup_location' => [
                    'id' => $booking->pickupLocation->id,
                    'city' => $booking->pickupLocation->city,
                    'name' => $booking->pickupLocation->name,
                ],
                'start_date' => $booking->start_date->toDateString(),
                'end_date' => $booking->end_date->toDateString(),
                'duration_days' => $booking->duration_days,
                'subtotal' => $booking->subtotal,
                'service_fee' => $booking->deposit_amount,
                'total_price' => $booking->total_price,
                'payment' => [
                    'method' => $payment->method,
                    'amount' => $payment->amount,
                    'status' => $payment->status,
                    'expires_at' => $payment->expires_at?->toDateTimeString(),
                ],
            ],
        ], 201);
    }
}
