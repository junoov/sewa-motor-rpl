<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cari-motor', [MotorController::class, 'index'])->name('motors.index');
Route::get('/cari-motor/{motor:slug}', [MotorController::class, 'show'])->name('motors.show');
Route::get('/bookings/create/{motor:slug}', [BookingController::class, 'create'])->name('bookings.create');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/lupa-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/lupa-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/account', [AccountController::class, 'show'])->name('account.show');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{motor:slug}', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking:order_number}', [PaymentController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking:order_number}/payment-method', [PaymentController::class, 'selectMethod'])->name('payments.select-method');
    Route::get('/bookings/{booking:order_number}/konfirmasi', [PaymentController::class, 'confirmForm'])->name('payments.confirm-form');
    Route::post('/bookings/{booking:order_number}/konfirmasi', [PaymentController::class, 'confirm'])->name('payments.confirm');
    Route::post('/bookings/{booking:order_number}/batalkan', [PaymentController::class, 'cancel'])->name('payments.cancel');
    Route::get('/bookings/{booking:order_number}/invoice', [PaymentController::class, 'invoice'])->name('payments.invoice');
    Route::post('/wishlist/{motor:slug}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/favorit', [WishlistController::class, 'index'])->name('wishlist.index');
});
