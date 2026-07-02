<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Location;
use App\Models\Motor;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request): View
    {
        $statuses = ['menunggu_pembayaran', 'menunggu_konfirmasi', 'dikonfirmasi', 'berlangsung', 'selesai', 'dibatalkan'];
        $selectedStatus = $request->string('status')->toString();
        $selectedStatus = in_array($selectedStatus, $statuses, true) ? $selectedStatus : null;

        $selectedMonth = $request->string('bulan')->toString();
        $search = $request->string('q')->toString();

        $bookings = Booking::query()
            ->with(['motor.brand', 'pickupLocation', 'payment'])
            ->where('user_id', $request->user()->id)
            ->when($selectedStatus, fn ($q) => $q->where('status', $selectedStatus))
            ->when($selectedMonth, function ($q) use ($selectedMonth) {
                $date = Carbon::createFromFormat('Y-m', $selectedMonth);
                if ($date) {
                    $q->whereBetween('start_date', [$date->startOfMonth(), $date->endOfMonth()]);
                }
            })
            ->when($search, fn ($q) => $q->where(function ($sub) use ($search) {
                $sub->where('order_number', 'like', "%{$search}%")
                   ->orWhereHas('motor', fn ($m) => $m->where('name', 'like', "%{$search}%"));
            }))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $months = Booking::query()
            ->where('user_id', $request->user()->id)
            ->selectRaw("DISTINCT DATE_FORMAT(start_date, '%Y-%m') as month")
            ->orderByDesc('month')
            ->pluck('month')
            ->toArray();

        return view('bookings.index', [
            'bookings' => $bookings,
            'statuses' => $statuses,
            'selectedStatus' => $selectedStatus,
            'selectedMonth' => $selectedMonth,
            'search' => $search,
            'months' => $months,
        ]);
    }

    public function create(Motor $motor): View
    {
        $motor->load(['brand', 'type', 'location']);

        return view('bookings.create', [
            'motor' => $motor,
            'locations' => Location::query()->where('is_active', true)->orderBy('city')->get(),
        ]);
    }

    public function store(Request $request, Motor $motor): RedirectResponse
    {
        $validMethods = 'bca,bri,mandiri,bni,gopay,ovo,dana,qris';

        $data = $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'pickup_location_id' => ['required', 'exists:locations,id'],
            'payment_method' => ['required', 'in:' . $validMethods],
            'notes' => ['nullable', 'string', 'max:500'],
            'terms' => ['accepted'],
        ]);

        $start = Carbon::parse($data['start_date'])->startOfDay();
        $end = Carbon::parse($data['end_date'])->startOfDay();
        $durationDays = max(1, $start->diffInDays($end));
        $subtotal = $durationDays * $motor->price_per_day;
        $serviceFee = 10000;
        $total = $subtotal + $serviceFee;

        $booking = Booking::create([
            'order_number' => 'MR-'.now()->format('Ymd').'-'.Str::upper(Str::random(5)),
            'user_id' => $request->user()->id,
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

        Payment::create([
            'booking_id' => $booking->id,
            'method' => $data['payment_method'],
            'amount' => $total,
            'expires_at' => now()->addHours(2),
        ]);

        return redirect()->route('bookings.show', $booking)->with('status', 'Booking berhasil dibuat. Silakan lanjutkan pembayaran.');
    }

}
