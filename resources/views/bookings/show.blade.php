@extends('layouts.app')

@section('title', 'Pembayaran '.$booking->order_number.' - MotoRent')

@section('pageHeader')
<div class="checkout-desktop-header">
  @include('partials.site-header')
</div>
@endsection

@section('content')
@php
  $motor = $booking->motor;
  $location = $booking->pickupLocation;
  $startDate = $booking->start_date->translatedFormat('d F Y');
  $endDate = $booking->end_date->translatedFormat('d F Y');
  $deadline = $booking->payment?->expires_at;
@endphp

<section class="payment-page">
  <header class="mobile-detail-topbar payment-mobile-detail-topbar">
    <a href="{{ $backUrl }}" class="mobile-detail-circle-btn" aria-label="Kembali">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </a>
    <div class="mobile-detail-topbar__title">Pembayaran</div>
    <div class="payment-mobile-detail-topbar__spacer" aria-hidden="true"></div>
  </header>

  @if(session('status'))
    <div class="payment-flash">{{ session('status') }}</div>
  @endif
  @if(session('error'))
    <div class="payment-flash is-error">{{ session('error') }}</div>
  @endif

  <div class="payment-title-row">
    <a href="{{ $backUrl }}" class="payment-back" aria-label="Kembali ke halaman sebelumnya">
      <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    </a>
    <div>
      <h1>Pembayaran</h1>
      <p class="payment-subtitle">Selesaikan pembayaran sebelum batas waktu berakhir.</p>
    </div>
  </div>

  @if(! $isExpired && $deadline)
  <div class="payment-timer-bar" data-expires-at="{{ $deadline->toIso8601String() }}">
    <div class="payment-timer-left">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
      <div>
        <small>Batas pembayaran</small>
        <b class="payment-countdown">--:--:--</b>
      </div>
    </div>
    <div class="payment-timer-right">
      <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
      <div>
        <small>Batas akhir pembayaran</small>
        <b>{{ $deadline->translatedFormat('d F Y H:i') }} WIB</b>
      </div>
    </div>
  </div>
  @endif

  <div class="payment-grid is-instruction">
    <div class="payment-left-stack">
      {{-- Ringkasan Pesanan --}}
      <article class="payment-order-card">
        <h2>Ringkasan Pesanan</h2>

        <div class="payment-motor-row">
          <img src="{{ asset($motor->image_path) }}" alt="{{ $motor->name }}">
          <div>
            <h3>{{ $motor->name }}</h3>
            <div class="payment-pills">
              <span><svg viewBox="0 0 24 24"><path d="M7 2v4M17 2v4M4 9h16M5 5h14v16H5V5Z"/></svg>{{ $startDate }} – {{ $endDate }} ({{ $booking->duration_days }} Hari)</span>
            </div>
            <div class="payment-pills">
              <span><svg viewBox="0 0 24 24"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>{{ $location->address }}, {{ $location->city }}</span>
            </div>
            <div class="payment-pills">
              <span><svg viewBox="0 0 24 24"><path d="M4 19h16"/><path d="M7 16V8"/><path d="M12 16V5"/><path d="M17 16v-4"/></svg>Kode Booking: {{ $booking->order_number }}</span>
            </div>
          </div>
        </div>

        <div class="payment-order-total">
          <span>Total</span>
          <strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong>
        </div>
      </article>

      @if(! $isExpired && $methodData)
      {{-- Informasi Transfer --}}
      <article class="payment-transfer-card">
        <h2>Informasi Transfer</h2>
        <div class="payment-transfer-body">
          <div class="payment-bank-logo">{{ $methodData['name'] }}</div>
          <div class="payment-bank-detail">
            <div>
              <small>Nomor Rekening</small>
              <b>{{ $methodData['account_number'] ?? '-' }}</b>
            </div>
            <div>
              <small>Atas Nama</small>
              <b>{{ $methodData['account_name'] }}</b>
            </div>
            <div class="payment-transfer-amount">
              <small>Total Transfer</small>
              <b>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</b>
            </div>
          </div>
        </div>
      </article>

      {{-- Langkah Pembayaran --}}
      <article class="payment-steps-card">
        <h2>Langkah Pembayaran</h2>
        <ol>
          @foreach($methodData['steps'] as $step)
            <li>{{ $step }}</li>
          @endforeach
        </ol>
      </article>
      @endif
    </div>

    <div class="payment-right-stack">
      {{-- Ringkasan Pembayaran --}}
      <article class="payment-summary-card">
        <h2>Ringkasan Pembayaran</h2>

        <div class="payment-summary-block">
          <small>Total Pembayaran</small>
          <strong class="payment-summary-total">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong>
        </div>

        <div class="payment-summary-block">
          <small>Status Pembayaran</small>
          <span class="payment-status-badge is-{{ $booking->status === 'dibatalkan' ? 'cancelled' : ($booking->status === 'menunggu verifikasi' ? 'verifying' : 'pending') }}">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            {{ ucfirst($booking->status) }}
          </span>
        </div>

        @if(! $isExpired && $deadline)
        <div class="payment-summary-block">
          <small>Batas pembayaran</small>
          <div class="payment-summary-timer">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <b class="payment-countdown">--:--:--</b>
          </div>
          <div class="payment-summary-deadline">
            <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
            <b>{{ $deadline->translatedFormat('d F Y H:i') }} WIB</b>
          </div>
        </div>
        @endif

        @if($booking->status === 'menunggu pembayaran' && ! $isExpired)
        <a href="{{ route('payments.confirm-form', $booking) }}" class="payment-confirm-btn">
          Konfirmasi Pembayaran
          <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <form method="POST" action="{{ route('payments.cancel', $booking) }}" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
          @csrf
          <button type="submit" class="payment-cancel-link">Batalkan Pesanan</button>
        </form>
        @elseif($booking->status === 'dibatalkan')
        <div class="payment-cancelled-note">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6"/><path d="M9 9l6 6"/></svg>
          <span>Pesanan ini dibatalkan karena melewati batas waktu pembayaran.</span>
        </div>
        <a href="{{ route('motors.index') }}" class="payment-confirm-btn is-secondary">Cari Motor Lain</a>
        @elseif($booking->status === 'menunggu verifikasi')
        <div class="payment-pending-note">
          <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-5"/></svg>
          <span>Bukti pembayaran sedang diverifikasi oleh admin.</span>
        </div>
        @endif

        @if($booking->status !== 'dibatalkan')
        <a href="{{ route('payments.invoice', $booking) }}" class="payment-cancel-link" style="margin-top: 14px; color: var(--blue);">
          Lihat Invoice
        </a>
        @endif
      </article>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  (() => {
    const timerBar = document.querySelector('[data-expires-at]');
    if (!timerBar) return;

    const expiresAt = new Date(timerBar.dataset.expiresAt);
    const countdownEls = document.querySelectorAll('.payment-countdown');

    const pad = (n) => String(n).padStart(2, '0');

    const update = () => {
      const now = new Date();
      const diff = expiresAt - now;

      if (diff <= 0) {
        countdownEls.forEach(el => el.textContent = '00:00:00');
        window.location.reload();
        return;
      }

      const hours = Math.floor(diff / 3600000);
      const minutes = Math.floor((diff % 3600000) / 60000);
      const seconds = Math.floor((diff % 60000) / 1000);
      const text = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
      countdownEls.forEach(el => el.textContent = text);
    };

    update();
    setInterval(update, 1000);
  })();
</script>
@endpush
