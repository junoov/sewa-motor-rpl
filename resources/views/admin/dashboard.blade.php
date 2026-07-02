@extends('layouts.app')

@section('title', 'Admin MotoRent')

@section('content')
<section class="catalog-page">
  <div class="section-header"><h2>Dashboard Admin</h2></div>
  <div class="admin-stats">
    <div class="stats-card mini"><strong>{{ $motorCount }}</strong><small>Total motor</small></div>
    <div class="stats-card mini"><strong>{{ $availableCount }}</strong><small>Motor tersedia</small></div>
    <div class="stats-card mini"><strong>{{ $bookingCount }}</strong><small>Total booking</small></div>
    <div class="stats-card mini"><strong>{{ $customerCount }}</strong><small>Pelanggan</small></div>
  </div>
  <div class="table-card">
    <h3>Booking terbaru</h3>
    @forelse($latestBookings as $booking)
      <div class="booking-row">
        <span><b>{{ $booking->order_number }}</b><small>{{ $booking->user->name }}</small></span>
        <span>{{ $booking->motor->name }}</span>
        <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
        <span class="badge">{{ $booking->status }}</span>
      </div>
    @empty
      <p class="empty-state">Belum ada booking.</p>
    @endforelse
  </div>
</section>
@endsection
