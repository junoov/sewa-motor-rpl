@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran '.$booking->order_number.' - MotoRent')

@section('pageHeader')
<div class="checkout-desktop-header">
  @include('partials.site-header')
</div>
@endsection

@section('content')
@php
  $motor = $booking->motor;
  $location = $booking->pickupLocation;
@endphp

<section class="checkout-page">
  <header class="checkout-mobile-topbar">
    <a href="{{ route('bookings.show', $booking) }}" class="checkout-mobile-topbar__back" aria-label="Kembali">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </a>
    <div class="checkout-mobile-topbar__title">Konfirmasi Pembayaran</div>
    <div class="checkout-mobile-topbar__spacer"></div>
  </header>

  <div class="checkout-title-row">
    <a class="checkout-back" href="{{ route('bookings.show', $booking) }}" aria-label="Kembali ke pembayaran">
      <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    </a>
    <div>
      <h1>Konfirmasi Pembayaran</h1>
      <p>Unggah bukti transfer untuk mempercepat verifikasi</p>
    </div>
  </div>

  <div class="checkout-grid">
    <div class="checkout-left">
      <article class="checkout-motor-card">
        <img src="{{ asset($motor->image_path) }}" alt="{{ $motor->name }}">
        <div class="checkout-motor-copy">
          <h2>{{ $motor->name }}</h2>
          <div class="checkout-rating">
            <svg viewBox="0 0 24 24"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            {{ $motor->rating }} ({{ $motor->reviews_count }}+ review)
          </div>
          <div class="checkout-pills">
            <span><svg viewBox="0 0 24 24"><path d="M4 13a8 8 0 0 1 16 0v3a2 2 0 0 1-2 2h-3.5"/><path d="M4 13v3a2 2 0 0 0 2 2h3"/><path d="M9 18v-3h6v3"/><path d="M7 13h10"/></svg>2 Helm</span>
            <span><svg viewBox="0 0 24 24"><path d="M8 9h8v7H8z"/><path d="M5 12H3"/><path d="M21 12h-2"/><path d="M10 6V4"/><path d="M14 6V4"/></svg>{{ $motor->cc }} cc</span>
            <span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="7"/><path d="M12 5v3"/><path d="M12 16v3"/><path d="M5 12h3"/><path d="M16 12h3"/><circle cx="12" cy="12" r="2"/></svg>{{ $motor->transmission }}</span>
          </div>
        </div>
        <div class="checkout-price">
          <strong>Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}</strong>
          <small>/hari</small>
        </div>
      </article>

      <article class="checkout-field-card">
        <span class="checkout-field-icon"><svg viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/></svg></span>
        <span class="checkout-field-content">
          <b>Metode Pembayaran</b>
          <span class="checkout-input-wrap">
            <svg viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/></svg>
            <input type="text" value="{{ $methodData['name'] ?? '-' }}" disabled>
          </span>
        </span>
      </article>

      <article class="checkout-field-card">
        <span class="checkout-field-icon"><svg viewBox="0 0 24 24"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
        <span class="checkout-field-content">
          <b>Lokasi Pengambilan</b>
          <span class="checkout-input-wrap">
            <svg viewBox="0 0 24 24"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
            <input type="text" value="{{ $location->name }} - {{ $location->city }}" disabled>
          </span>
        </span>
      </article>
    </div>

    <aside class="checkout-right">
      <form method="POST" action="{{ route('payments.confirm', $booking) }}" enctype="multipart/form-data" class="checkout-summary-card">
        @csrf
        <h2>Unggah Bukti Pembayaran</h2>

        <div class="checkout-summary-line">
          <span>Total Pembayaran</span>
          <b>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</b>
        </div>

        <div style="margin-top: 18px;">
          <label style="display: grid; gap: 8px; margin-bottom: 16px;">
            <span style="color: #111827; font-size: 14px; font-weight: 800;">Nama Pengirim</span>
            <input type="text" name="payer_name" value="{{ old('payer_name', auth()->user()->name) }}" required placeholder="Contoh: Budi Santoso" style="height: 52px; padding: 0 14px; border: 1px solid rgba(224, 232, 244, 0.96); border-radius: 8px; font-size: 15px; font-weight: 650;">
            @error('payer_name')<small class="error-text">{{ $message }}</small>@enderror
          </label>

          <label style="display: grid; gap: 8px;">
            <span style="color: #111827; font-size: 14px; font-weight: 800;">Bukti Transfer / Pembayaran</span>
            <span style="color: #647084; font-size: 13px; font-weight: 650;">Format: JPG, PNG (maks 5 MB)</span>
            <input type="file" name="proof" accept="image/jpeg,image/png,image/jpg" required style="padding: 12px 0; font-size: 14px;">
            @error('proof')<small class="error-text">{{ $message }}</small>@enderror
          </label>
        </div>

        <button class="checkout-submit-btn" type="submit" style="margin-top: 24px;">Kirim Bukti Pembayaran</button>
        <p class="payment-terms" style="margin-top: 14px;">Pastikan bukti pembayaran terlihat jelas agar verifikasi lebih cepat.</p>
      </form>
    </aside>
  </div>
</section>
@endsection
