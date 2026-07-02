@extends('layouts.app')

@section('title', 'Akun Saya - MotoRent')

@section('pageHeader')
<div class="account-desktop-header">
  @include('partials.site-header')
</div>
@endsection

@section('content')
@php
  $userInitial = strtoupper(substr($user->name, 0, 1));
@endphp
<section class="account-hub-page account-hub-reference">
  <header class="account-mobile-topbar">
    <a href="{{ route('home') }}" class="account-mobile-topbar__icon" aria-label="Beranda">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h16"/></svg>
    </a>
    <a href="{{ route('home') }}" class="account-mobile-topbar__brand" aria-label="MotoRent">
      <svg viewBox="0 0 52 44" class="account-mobile-topbar__logo" aria-hidden="true">
        <circle cx="15" cy="31" r="6.7"/>
        <circle cx="41" cy="31" r="6.7"/>
        <path d="M15 31h8.5l6-15.8h7.6L41 31"/>
        <path d="M24.5 31h10.2l-7.4-12.3M34.8 15.2h8.4M20.8 17h8.1"/>
        <path d="M13 19h9.8"/>
        <path d="M25.5 8.5h8.8"/>
      </svg>
      <span>MotoRent</span>
    </a>
    <a href="{{ route('account.show') }}" class="account-mobile-topbar__icon" aria-label="Akun Saya">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    </a>
  </header>

  <div class="account-hub-mobile-intro">
    <h2>Akun Saya</h2>
    <p>Kelola informasi akun dan keamanan Anda</p>
  </div>

  @if(session('status'))
    <div class="account-hub-flash">{{ session('status') }}</div>
  @endif

  <article class="account-hub-hero">
    <div class="account-hub-identity">
      <div class="account-hub-avatar">{{ $userInitial }}</div>
      <div>
        <h1>{{ $user->name }}</h1>
        <div class="account-hub-meta-row">
          <span>{{ $user->email }}</span>
          <span>{{ $user->phone ?: 'No. HP belum diisi' }}</span>
        </div>
      </div>
    </div>
    <div class="account-hub-hero-actions">
      <span class="account-hub-status {{ $user->verification_status === 'terverifikasi' ? 'is-verified' : '' }}">{{ $user->verification_status }}</span>
    </div>
  </article>

  <nav class="account-hub-nav" aria-label="Navigasi akun">
    <button type="button" class="account-hub-nav-item is-active" data-account-nav="profile">
      <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      <span>Profil Saya</span>
    </button>
    <button type="button" class="account-hub-nav-item" data-account-nav="activity">
      <svg viewBox="0 0 24 24"><path d="M4 19h16"/><path d="M7 16V8"/><path d="M12 16V5"/><path d="M17 16v-4"/></svg>
      <span>Ringkasan Aktivitas</span>
    </button>
    <button type="button" class="account-hub-nav-item" data-account-nav="verification">
      <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-5"/></svg>
      <span>Verifikasi</span>
    </button>
  </nav>

  <div class="account-hub-content">
    <article class="account-hub-card" data-account-panel="profile">
      <div class="account-hub-card-head">
        <div>
          <h2>Profil Saya</h2>
          <p>Perbarui data akun agar proses pemesanan dan verifikasi berjalan lebih mulus.</p>
        </div>
        <div class="account-hub-verify-banner">
          <div class="account-hub-verify-copy">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-5"/></svg>
            <p>Verifikasi akun untuk pengalaman sewa yang lebih aman & cepat.</p>
          </div>
          <button type="button" class="account-hub-outline-btn">Verifikasi Sekarang</button>
        </div>
      </div>

      <form method="POST" action="{{ route('account.update') }}" class="account-hub-form">
        @csrf
        @method('PATCH')

        <label>
          <span>Nama lengkap</span>
          <input type="text" name="name" value="{{ old('name', $user->name) }}" autocomplete="name" required>
          @error('name')<small class="error-text">{{ $message }}</small>@enderror
        </label>

        <label>
          <span>Email</span>
          <input type="email" name="email" value="{{ old('email', $user->email) }}" autocomplete="email" required>
          @error('email')<small class="error-text">{{ $message }}</small>@enderror
        </label>

        <label>
          <span>No. HP</span>
          <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" autocomplete="tel" required>
          @error('phone')<small class="error-text">{{ $message }}</small>@enderror
        </label>

        <label>
          <span>Username</span>
          <input type="text" value="{{ '@'.\Illuminate\Support\Str::slug($user->name, '') }}" disabled>
        </label>

        <label class="is-full">
          <span>Alamat</span>
          <textarea name="address" rows="4" autocomplete="street-address" placeholder="Masukkan alamat lengkap Anda">{{ old('address', $user->address) }}</textarea>
          @error('address')<small class="error-text">{{ $message }}</small>@enderror
        </label>

        <label>
          <span>Password baru</span>
          <input type="password" name="password" autocomplete="new-password" placeholder="Kosongkan jika tidak ingin mengubah">
          @error('password')<small class="error-text">{{ $message }}</small>@enderror
        </label>

        <label>
          <span>Konfirmasi password baru</span>
          <input type="password" name="password_confirmation" autocomplete="new-password" placeholder="Masukkan konfirmasi password baru">
        </label>

        <div class="account-hub-form-actions is-full">
          <button type="submit" class="account-hub-primary-btn">Simpan Perubahan</button>
        </div>
      </form>
    </article>

    <article class="account-hub-card is-hidden" data-account-panel="activity">
      <div class="account-hub-card-head compact">
        <div>
          <h2>Ringkasan Aktivitas</h2>
          <p>Semua aktivitas pemesananmu ditampilkan di sini, termasuk transaksi yang masih menunggu pembayaran.</p>
        </div>
        <span class="account-hub-inline-link">Semua booking</span>
      </div>

      <div class="account-hub-stats-grid with-margin">
        <article><small>Total pemesanan</small><strong>{{ $stats['total_bookings'] }}</strong></article>
        <article><small>Menunggu pembayaran</small><strong>{{ $stats['pending_payment'] }}</strong></article>
        <article><small>Booking aktif</small><strong>{{ $stats['active_rentals'] }}</strong></article>
        <article><small>Total transaksi</small><strong>Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</strong></article>
      </div>

      <div class="account-hub-booking-list">
        @forelse($recentBookings as $booking)
          <a href="{{ route('bookings.show', ['booking' => $booking, 'return_to' => url()->full().'#account-activity']) }}" class="account-hub-booking-item">
            <div class="account-hub-booking-main">
              <strong>{{ $booking->motor->name }}</strong>
              <small>{{ $booking->order_number }} · {{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}</small>
            </div>
            <div class="account-hub-booking-side">
              <span class="account-hub-booking-price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
              <span class="account-hub-booking-badge {{ $booking->status === 'dibatalkan' ? 'is-red' : '' }}">{{ $booking->status }}</span>
            </div>
          </a>
        @empty
          <div class="account-hub-empty-state">
            <h3>Belum ada riwayat pemesanan</h3>
            <p>Pilih motor favoritmu dulu, lalu booking dari katalog MotoRent.</p>
            <a href="{{ route('motors.index') }}" class="account-hub-primary-btn is-link">Cari Motor</a>
          </div>
        @endforelse
      </div>
    </article>

    <article class="account-hub-card is-hidden" data-account-panel="verification">
      <div class="account-hub-card-head compact">
        <div>
          <span class="account-hub-status {{ $user->verification_status === 'terverifikasi' ? 'is-verified' : '' }}">{{ $user->verification_status }}</span>
          <h2>Status Verifikasi</h2>
          <p>Pastikan data identitas lengkap sebelum proses verifikasi lanjutan.</p>
        </div>
      </div>
      <div class="account-hub-doc-grid">
        <article><small>KTP</small><strong>{{ $user->ktp_path ? 'Tersimpan' : 'Belum upload' }}</strong></article>
        <article><small>SIM</small><strong>{{ $user->sim_path ? 'Tersimpan' : 'Belum upload' }}</strong></article>
      </div>
    </article>
  </div>
</section>

@push('scripts')
<script>
  (() => {
    const navItems = Array.from(document.querySelectorAll('[data-account-nav]'));
    const panels = Array.from(document.querySelectorAll('[data-account-panel]'));

    if (!navItems.length || !panels.length) {
      return;
    }

    const activatePanel = (panelName) => {
      navItems.forEach((item) => {
        item.classList.toggle('is-active', item.dataset.accountNav === panelName);
      });

      panels.forEach((panel) => {
        const isActive = panel.dataset.accountPanel === panelName;
        panel.classList.toggle('is-hidden', !isActive);
        panel.hidden = !isActive;
      });
    };

    navItems.forEach((item) => {
      item.addEventListener('click', () => {
        const panelName = item.dataset.accountNav;
        history.replaceState(null, '', `#account-${panelName}`);
        activatePanel(panelName);
      });
    });

    const hash = window.location.hash.replace('#account-', '');
    const initialPanel = navItems.some((item) => item.dataset.accountNav === hash) ? hash : 'profile';
    activatePanel(initialPanel);
  })();
</script>
@endpush
@endsection
