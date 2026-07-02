<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        $bookings = Booking::query()
            ->with(['motor.brand', 'pickupLocation', 'payment'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('account.show', [
            'user' => $user,
            'recentBookings' => $bookings,
            'stats' => [
                'total_bookings' => $bookings->count(),
                'pending_payment' => $bookings->where('status', 'menunggu pembayaran')->count(),
                'active_rentals' => $bookings->filter(fn (Booking $booking) => $booking->status !== 'selesai')->count(),
                'total_spent' => $bookings->sum('total_price'),
            ],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:500'],
            'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $user->update($data);

        return back()->with('status', 'Profil akun berhasil diperbarui.');
    }
}
