@extends('layouts.app')

@section('title', 'Riwayat Booking - MotoRent')

@section('pageHeader')
<div class="booking-history-desktop-header">
  @include('partials.site-header')
</div>
@endsection

@section('content')
@php
$statusLabels = [
    'menunggu_pembayaran' => 'Menunggu Pembayaran',
    'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
    'dikonfirmasi' => 'Dikonfirmasi',
    'berlangsung' => 'Berlangsung',
    'selesai' => 'Selesai',
    'dibatalkan' => 'Dibatalkan',
];
$monthLabels = [];
foreach ($months as $m) {
    $monthLabels[$m] = Carbon\Carbon::createFromFormat('Y-m', $m)->translatedFormat('F Y');
}
@endphp

<section class="booking-history-page">
  <header class="booking-history-mobile-topbar">
    <a href="{{ route('account.show') }}" class="booking-history-mobile-topbar__back" aria-label="Kembali ke akun">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </a>
    <div class="booking-history-mobile-topbar__title">Riwayat Booking</div>
    <a href="{{ route('motors.index') }}" class="booking-history-mobile-topbar__action" aria-label="Cari motor">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
    </a>
  </header>

  <div class="booking-history-hero">
    <div>
      <p class="booking-history-eyebrow">Pesanan Saya</p>
      <h1>Riwayat Booking</h1>
      <p>Lacak semua pemesananmu di satu tempat. Gunakan filter untuk mencari booking tertentu.</p>
    </div>
    <a href="{{ route('motors.index') }}" class="booking-history-book-btn">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
      Cari Motor
    </a>
  </div>

  <form method="GET" action="{{ route('bookings.index') }}" class="booking-history-filters" data-booking-filters>
    <div class="booking-history-filter-row">
      <div class="booking-history-search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari nomor order atau nama motor..." class="booking-history-search">
      </div>

      <select name="status" class="booking-history-select" data-booking-filter-status>
        <option value="">Semua Status</option>
        @foreach($statuses as $s)
          <option value="{{ $s }}" {{ $selectedStatus === $s ? 'selected' : '' }}>{{ $statusLabels[$s] }}</option>
        @endforeach
      </select>

      <select name="bulan" class="booking-history-select" data-booking-filter-month>
        <option value="">Semua Bulan</option>
        @foreach($months as $m)
          <option value="{{ $m }}" {{ $selectedMonth === $m ? 'selected' : '' }}>{{ $monthLabels[$m] ?? $m }}</option>
        @endforeach
      </select>

      <button type="submit" class="booking-history-filter-btn">Terapkan</button>
      @if($selectedStatus || $selectedMonth || $search)
        <a href="{{ route('bookings.index') }}" class="booking-history-reset-btn">Reset</a>
      @endif
    </div>
  </form>

  <div class="booking-history-list">
    @forelse($bookings as $booking)
      <a href="{{ route('bookings.show', $booking) }}" class="booking-history-card">
        <img src="{{ asset($booking->motor->image_path) }}" alt="{{ $booking->motor->name }}" class="booking-history-thumb" loading="lazy">

        <div class="booking-history-body">
          <div class="booking-history-body-top">
            <strong>{{ $booking->motor->name }}</strong>
            <span class="booking-history-badge {{ $booking->status === 'dibatalkan' ? 'is-red' : ($booking->status === 'selesai' ? 'is-green' : '') }}">
              @if($booking->status === 'dibatalkan')
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
              @elseif($booking->status === 'selesai')
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
              @else
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
              @endif
              {{ $statusLabels[$booking->status] ?? $booking->status }}
            </span>
          </div>
          <small class="booking-history-order">#{{ $booking->order_number }}</small>
          <div class="booking-history-meta">
            <span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
              {{ $booking->start_date->format('d M Y') }} – {{ $booking->end_date->format('d M Y') }}
            </span>
            <span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"/></svg>
              {{ $booking->pickupLocation?->city ?? '-' }}
            </span>
          </div>
        </div>

        <div class="booking-history-price-col">
          <span class="booking-history-price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
          <small>{{ $booking->duration_days }} hari</small>
        </div>

        <svg class="booking-history-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
      </a>
    @empty
      <div class="booking-history-empty">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
        <h3>{{ $selectedStatus || $selectedMonth || $search ? 'Tidak ada booking ditemukan' : 'Belum ada riwayat pemesanan' }}</h3>
        <p>{{ $selectedStatus || $selectedMonth || $search ? 'Coba ubah filter atau kata kunci pencarian.' : 'Pilih motor favoritmu dulu, lalu booking dari katalog MotoRent.' }}</p>
        @if(!$selectedStatus && !$selectedMonth && !$search)
          <a href="{{ route('motors.index') }}" class="booking-history-book-btn is-inline">Cari Motor</a>
        @endif
      </div>
    @endforelse
  </div>

  @if($bookings->hasPages())
    <div class="booking-history-pagination">
      {{ $bookings->links() }}
    </div>
  @endif
</section>

@push('scripts')
<script>
  (() => {
    const statusSelect = document.querySelector('[data-booking-filter-status]');
    const monthSelect = document.querySelector('[data-booking-filter-month]');
    const form = document.querySelector('[data-booking-filters]');

    if (statusSelect) {
      statusSelect.addEventListener('change', () => form.requestSubmit());
    }
    if (monthSelect) {
      monthSelect.addEventListener('change', () => form.requestSubmit());
    }
  })();
</script>
@endpush
@endsection
