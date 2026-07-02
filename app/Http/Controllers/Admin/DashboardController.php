<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Motor;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'motorCount' => Motor::count(),
            'availableCount' => Motor::where('status', 'tersedia')->count(),
            'bookingCount' => Booking::count(),
            'customerCount' => User::where('role', 'customer')->count(),
            'latestBookings' => Booking::with(['user', 'motor'])->latest()->take(5)->get(),
        ]);
    }
}
