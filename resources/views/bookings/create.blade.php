@extends('layouts.app')

@section('title', 'Booking '.$motor->name.' - MotoRent')

@section('pageHeader')
<div class="checkout-desktop-header">
  @include('partials.site-header')
</div>
@endsection

@section('content')
@php
  $mobileBack = route('motors.show', $motor);
@endphp
@php
  $serviceFee = 10000;
  $defaultStart = old('start_date', now()->addDay()->toDateString());
  $defaultEnd = old('end_date', now()->addDays(3)->toDateString());
  $durationDays = max(1, (int) \Illuminate\Support\Carbon::parse($defaultStart)->startOfDay()->diffInDays(\Illuminate\Support\Carbon::parse($defaultEnd)->startOfDay()));
  $subtotal = $motor->price_per_day * $durationDays;
  $total = $subtotal + $serviceFee;
@endphp

<section class="checkout-page">
  <header class="checkout-mobile-topbar">
    <a href="{{ $mobileBack }}" class="checkout-mobile-topbar__back" aria-label="Kembali">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </a>
    <div class="checkout-mobile-topbar__title">Booking Motor</div>
    <div class="checkout-mobile-topbar__spacer"></div>
  </header>

  <div class="checkout-title-row">
    <a class="checkout-back" href="{{ route('motors.show', $motor) }}" aria-label="Kembali ke detail motor">
      <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    </a>
    <div>
      <h1>Booking Motor</h1>
      <p>Lengkapi detail pemesanan dan lanjutkan pembayaran</p>
    </div>
  </div>

  <form method="POST" action="{{ route('bookings.store', $motor) }}" class="checkout-grid" data-price-per-day="{{ $motor->price_per_day }}" data-service-fee="{{ $serviceFee }}">
    @csrf
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

      <label class="checkout-field-card">
        <span class="checkout-field-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
        <span class="checkout-field-content">
          <b>Lokasi Pengambilan</b>
          <span class="checkout-input-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
            <select name="pickup_location_id" required>
              <option value="" disabled>Pilih lokasi pengambilan</option>
              @foreach($locations as $location)
                <option value="{{ $location->id }}" @selected(old('pickup_location_id', $motor->location_id) == $location->id)>{{ $location->name }} - {{ $location->city }}</option>
              @endforeach
            </select>
          </span>
          @error('pickup_location_id')<small class="error-text">{{ $message }}</small>@enderror
        </span>
        <span class="checkout-field-chevron">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </span>
      </label>

      <label class="checkout-field-card">
        <span class="checkout-field-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg></span>
        <span class="checkout-field-content">
          <b>Tanggal Mulai</b>
          <span class="checkout-input-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
            <input id="checkout-start-date" name="start_date" type="date" value="{{ $defaultStart }}" min="{{ now()->toDateString() }}" required>
          </span>
          @error('start_date')<small class="error-text">{{ $message }}</small>@enderror
        </span>
        <span class="checkout-field-chevron">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </span>
      </label>

      <label class="checkout-field-card">
        <span class="checkout-field-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg></span>
        <span class="checkout-field-content">
          <b>Tanggal Selesai</b>
          <span class="checkout-input-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
            <input id="checkout-end-date" name="end_date" type="date" value="{{ $defaultEnd }}" min="{{ now()->addDay()->toDateString() }}" required>
          </span>
          @error('end_date')<small class="error-text">{{ $message }}</small>@enderror
        </span>
        <span class="checkout-field-chevron">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </span>
      </label>

      <article class="checkout-field-card">
        <span class="checkout-field-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/></svg></span>
        <span class="checkout-field-content">
          <b>Metode Pembayaran</b>
          <span class="checkout-input-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/></svg>
            <select name="payment_method" required>
              <option value="" disabled selected>Pilih metode pembayaran</option>
              <option value="bca" @selected(old('payment_method') === 'bca')>Transfer Bank BCA</option>
              <option value="bri" @selected(old('payment_method') === 'bri')>Transfer Bank BRI</option>
              <option value="mandiri" @selected(old('payment_method') === 'mandiri')>Transfer Bank Mandiri</option>
              <option value="bni" @selected(old('payment_method') === 'bni')>Transfer Bank BNI</option>
              <option value="gopay" @selected(old('payment_method') === 'gopay')>GoPay</option>
              <option value="ovo" @selected(old('payment_method') === 'ovo')>OVO</option>
              <option value="dana" @selected(old('payment_method') === 'dana')>DANA</option>
              <option value="qris" @selected(old('payment_method') === 'qris')>QRIS</option>
            </select>
          </span>
          @error('payment_method')<small class="error-text">{{ $message }}</small>@enderror
        </span>
        <span class="checkout-field-chevron">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </span>
      </article>

      <label class="checkout-safe-card">
        <input name="terms" type="checkbox" value="1" checked required>
        <span><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-5"/></svg></span>
        <b>Pemesanan aman &amp; terpercaya</b>
        <small>Data dan transaksi Anda dilindungi dengan enkripsi tingkat tinggi.</small>
      </label>
      @error('terms')<small class="error-text">{{ $message }}</small>@enderror
    </div>

    <aside class="checkout-right">
      <article class="checkout-summary-card">
        <h2>Ringkasan Pembayaran</h2>
        <div class="checkout-summary-line">
          <span>Harga Sewa (<span data-checkout-duration>{{ $durationDays }}</span> hari)</span>
          <b data-checkout-subtotal>Rp {{ number_format($subtotal, 0, ',', '.') }}</b>
        </div>
        <div class="checkout-summary-line">
          <span>Biaya Layanan <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg></span>
          <b>Rp {{ number_format($serviceFee, 0, ',', '.') }}</b>
        </div>
        <div class="checkout-total-line">
          <strong>Total Pembayaran</strong>
          <b data-checkout-total>Rp {{ number_format($total, 0, ',', '.') }}</b>
        </div>
        <button class="checkout-submit-btn" type="submit">Lanjutkan Pembayaran</button>
        <div class="checkout-secure">
          <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-5"/></svg>
          <span><b>Pembayaran 100% aman</b><small>Kami tidak menyimpan detail kartu Anda.</small></span>
        </div>
      </article>

      <article class="checkout-flex-card">
        <span><svg viewBox="0 0 24 24"><path d="M7 2v4M17 2v4M4 9h16M5 5h14v16H5V5Z"/><path d="m9 15 2 2 4-5"/></svg></span>
        <div>
          <b>Sewa fleksibel</b>
          <p>Ubah atau batalkan pesanan hingga 24 jam sebelum waktu mulai sewa.</p>
          <a href="#">Lihat Syarat &amp; Ketentuan</a>
        </div>
      </article>
    </aside>
  </form>
</section>
@endsection

@push('scripts')
<script>
  (() => {
    const form = document.querySelector('[data-price-per-day][data-service-fee]');
    const startInput = document.getElementById('checkout-start-date');
    const endInput = document.getElementById('checkout-end-date');
    const durationOutput = document.querySelector('[data-checkout-duration]');
    const subtotalOutput = document.querySelector('[data-checkout-subtotal]');
    const totalOutput = document.querySelector('[data-checkout-total]');

    if (!form || !startInput || !endInput || !durationOutput || !subtotalOutput || !totalOutput) {
      return;
    }

    const pricePerDay = Number(form.dataset.pricePerDay);
    const serviceFee = Number(form.dataset.serviceFee);
    const dayInMilliseconds = 24 * 60 * 60 * 1000;
    const rupiah = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      maximumFractionDigits: 0,
    });

    const parseDate = (value) => new Date(`${value}T00:00:00`);
    const formatDateValue = (date) => {
      const year = date.getFullYear();
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const day = String(date.getDate()).padStart(2, '0');

      return `${year}-${month}-${day}`;
    };
    const nextDateValue = (date) => {
      const nextDate = new Date(date);
      nextDate.setDate(nextDate.getDate() + 1);
      return formatDateValue(nextDate);
    };

    const refreshSummary = () => {
      const startDate = parseDate(startInput.value);
      const endDate = parseDate(endInput.value);

      if (Number.isNaN(startDate.getTime()) || Number.isNaN(endDate.getTime())) {
        return;
      }

      const minimumEndDate = nextDateValue(startDate);
      endInput.min = minimumEndDate;

      let updatedEndDate = endDate;

      if (updatedEndDate <= startDate) {
        endInput.value = minimumEndDate;
        updatedEndDate = parseDate(endInput.value);
      }

      const durationDays = Math.max(1, Math.round((updatedEndDate - startDate) / dayInMilliseconds));
      const subtotal = durationDays * pricePerDay;
      const total = subtotal + serviceFee;

      durationOutput.textContent = durationDays;
      subtotalOutput.textContent = rupiah.format(subtotal);
      totalOutput.textContent = rupiah.format(total);
    };

    startInput.addEventListener('change', refreshSummary);
    endInput.addEventListener('change', refreshSummary);
    startInput.addEventListener('input', refreshSummary);
    endInput.addEventListener('input', refreshSummary);
    refreshSummary();
  })();
</script>
@endpush
