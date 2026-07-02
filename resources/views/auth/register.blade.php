@extends('layouts.app')

@section('title', 'Daftar - MotoRent')

@section('pageHeader')@endsection

@push('head')
<style>
  .auth-page {
    min-height: 100dvh;
    padding: clamp(20px, 4vw, 40px);
    background: #ffffff;
  }

  .auth-shell {
    width: min(100%, 1120px);
    min-height: calc(100dvh - clamp(40px, 8vw, 80px));
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(320px, 0.92fr) minmax(0, 1.08fr);
    gap: clamp(20px, 3vw, 38px);
    align-items: stretch;
  }

  .auth-showcase {
    position: relative;
    border-radius: 30px;
    padding: 30px 28px 24px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: linear-gradient(180deg, #0f5dff 0%, #2d74ff 52%, #5b94ff 100%);
    color: #ffffff;
  }

  .auth-showcase::after {
    content: "";
    position: absolute;
    inset: auto 0 0;
    height: 42%;
    background: linear-gradient(180deg, rgba(8, 28, 70, 0), rgba(8, 28, 70, 0.18));
    pointer-events: none;
  }

  .auth-brand,
  .auth-form-brand {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    color: inherit;
    font-size: 1.04rem;
    font-weight: 900;
    letter-spacing: -0.02em;
    text-decoration: none;
  }

  .auth-brand img,
  .auth-form-brand img {
    width: 28px;
    height: 28px;
  }

  .auth-showcase-copy {
    position: relative;
    z-index: 1;
    max-width: 360px;
    margin-top: 34px;
  }

  .auth-showcase-copy h2 {
    margin: 0;
    font-size: clamp(2rem, 3vw, 3rem);
    line-height: 1.08;
    letter-spacing: -0.045em;
    font-weight: 900;
  }

  .auth-showcase-copy p {
    margin: 16px 0 0;
    color: rgba(255, 255, 255, 0.92);
    font-size: 1rem;
    line-height: 1.7;
    font-weight: 500;
  }

  .auth-feature-list {
    position: relative;
    z-index: 1;
    display: grid;
    gap: 14px;
    margin-top: 24px;
  }

  .auth-feature-item {
    display: grid;
    grid-template-columns: 38px minmax(0, 1fr);
    gap: 12px;
    align-items: start;
  }

  .auth-feature-icon {
    width: 38px;
    height: 38px;
    display: grid;
    place-items: center;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.16);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.18);
  }

  .auth-feature-icon svg {
    width: 18px;
    height: 18px;
    stroke: #ffffff;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .auth-feature-copy strong {
    display: block;
    font-size: 0.92rem;
    font-weight: 800;
  }

  .auth-feature-copy span {
    display: block;
    margin-top: 4px;
    color: rgba(255, 255, 255, 0.86);
    font-size: 0.82rem;
    line-height: 1.5;
  }

  .auth-showcase-figure {
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    min-height: 240px;
    margin-top: 22px;
  }

  .auth-showcase-figure::before {
    content: "";
    position: absolute;
    left: 50%;
    bottom: 16px;
    width: min(86%, 340px);
    height: 32px;
    border-radius: 999px;
    background: rgba(5, 20, 58, 0.26);
    transform: translateX(-50%);
    filter: blur(14px);
  }

  .auth-showcase-figure img {
    position: relative;
    z-index: 1;
    width: min(100%, 340px);
    height: auto;
    object-fit: contain;
    filter: drop-shadow(0 24px 34px rgba(5, 20, 58, 0.28));
  }

  .auth-panel {
    padding: 30px clamp(24px, 3vw, 38px) 28px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.72);
    backdrop-filter: blur(8px);
  }

  .auth-mobile-head {
    display: none;
  }

  .auth-panel-header h1 {
    margin: 0;
    color: #13203a;
    font-size: clamp(1.8rem, 2.2vw, 2.4rem);
    line-height: 1.12;
    letter-spacing: -0.04em;
    font-weight: 900;
  }

  .auth-panel-header p {
    margin: 12px 0 0;
    color: #6c7b92;
    font-size: 0.98rem;
    line-height: 1.7;
    font-weight: 500;
  }

  .auth-form {
    display: grid;
    gap: 14px;
    margin-top: 28px;
  }

  .auth-field {
    display: grid;
    gap: 8px;
  }

  .auth-field label,
  .auth-check {
    color: #334155;
    font-size: 0.9rem;
    font-weight: 700;
  }

  .auth-input-wrap {
    position: relative;
  }

  .auth-input {
    width: 100%;
    height: 50px;
    padding: 0 16px;
    border: 1px solid #dfe7f4;
    border-radius: 14px;
    background: #ffffff;
    color: #13203a;
    font-size: 0.95rem;
    font-weight: 500;
    outline: none;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 10px 24px rgba(17, 42, 79, 0.03);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .auth-input:focus {
    border-color: #8db2ff;
    box-shadow: 0 0 0 4px rgba(7, 92, 255, 0.08);
  }

  .auth-input-wrap .auth-input {
    padding-right: 50px;
  }

  .auth-toggle {
    position: absolute;
    right: 6px;
    top: 5px;
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 0;
    border-radius: 12px;
    background: transparent;
    color: #8b97ab;
    cursor: pointer;
  }

  .auth-toggle svg {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .auth-error {
    color: #dc2626;
    font-size: 0.78rem;
    font-weight: 700;
  }

  .auth-hint {
    color: #7a879a;
    font-size: 0.76rem;
    line-height: 1.5;
    font-weight: 600;
  }

  .auth-check {
    display: inline-flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 2px;
    color: #526179;
    font-size: 0.84rem;
    line-height: 1.6;
  }

  .auth-check input {
    width: 16px;
    height: 16px;
    margin-top: 2px;
    accent-color: #075cff;
    flex-shrink: 0;
  }

  .auth-check strong {
    color: #075cff;
    font-weight: 800;
  }

  .auth-submit {
    width: 100%;
    height: 52px;
    margin-top: 2px;
    border: 0;
    border-radius: 14px;
    background: linear-gradient(180deg, #1c71ff 0%, #075cff 100%);
    color: #ffffff;
    font-size: 1rem;
    font-weight: 900;
    letter-spacing: -0.02em;
    box-shadow: 0 18px 34px rgba(7, 92, 255, 0.26);
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .auth-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 22px 40px rgba(7, 92, 255, 0.3);
  }

  .auth-footnote {
    margin-top: 18px;
    color: #6c7b92;
    font-size: 0.92rem;
    text-align: center;
    font-weight: 500;
  }

  .auth-footnote a {
    color: #075cff;
    font-weight: 800;
    text-decoration: none;
  }

  @media (max-width: 900px) {
    .auth-page {
      padding: 18px 14px;
    }

    .auth-shell {
      min-height: calc(100dvh - 36px);
      grid-template-columns: 1fr;
      gap: 0;
    }

    .auth-showcase {
      display: none;
    }

    .auth-panel {
      padding: 18px 16px 24px;
      justify-content: flex-start;
      border-radius: 0;
      background: transparent;
      box-shadow: none;
    }

    .auth-mobile-head {
      display: none;
    }

    .auth-panel-header {
      display: grid;
      grid-template-columns: 48px minmax(0, 1fr);
      align-items: start;
      column-gap: 14px;
    }

    .auth-panel-header h1,
    .auth-panel-header p {
      grid-column: 2;
    }

    .auth-panel-header h1 {
      position: relative;
      min-height: 48px;
      display: flex;
      align-items: center;
      margin-top: 0;
      font-size: 1.5rem;
      line-height: 1.16;
    }

    .auth-mobile-back {
      grid-column: 1;
      grid-row: 1;
      width: 48px;
      height: 48px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #dfe7f4;
      border-radius: 999px;
      background: #ffffff;
      color: #1b2740;
      box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
      text-decoration: none;
    }

    .auth-mobile-back svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .auth-panel-header p {
      font-size: 0.9rem;
      line-height: 1.6;
    }
  }
</style>
@endpush

@section('content')
<section class="auth-page">
  <div class="auth-shell">
    <aside class="auth-showcase" aria-hidden="true">
      <a href="{{ route('home') }}" class="auth-brand">
        <img src="{{ asset('assets/logo-motorent.svg') }}" alt="MotoRent">
        <span>MotoRent</span>
      </a>

      <div>
        <div class="auth-showcase-copy">
          <h2>Buat Akun, Sewa Jadi Lebih Mudah</h2>
          <p>Daftar untuk menyimpan motor favorit, mempercepat proses booking, dan memantau semua pesananmu di satu tempat.</p>
        </div>

        <div class="auth-feature-list">
          <div class="auth-feature-item">
            <div class="auth-feature-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 6v6l4 2"/><circle cx="12" cy="12" r="9"/></svg></div>
            <div class="auth-feature-copy"><strong>Proses cepat &amp; mudah</strong><span>Daftar hanya dalam hitungan detik.</span></div>
          </div>
          <div class="auth-feature-item">
            <div class="auth-feature-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-7-4.5-9.2-9.1C1.1 8.3 3.2 4.5 7 4.5c2 0 3.6 1.1 5 3 1.4-1.9 3-3 5-3 3.8 0 5.9 3.8 4.2 7.4C19 16.5 12 21 12 21Z"/></svg></div>
            <div class="auth-feature-copy"><strong>Promo eksklusif</strong><span>Dapatkan penawaran khusus untuk member terdaftar.</span></div>
          </div>
          <div class="auth-feature-item">
            <div class="auth-feature-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6h16v12H4z"/><path d="M8 10h8"/><path d="M8 14h5"/></svg></div>
            <div class="auth-feature-copy"><strong>Riwayat sewa tersimpan</strong><span>Kelola semua pesanan dan perjalanan favorit dengan rapi.</span></div>
          </div>
        </div>
      </div>

      <div class="auth-showcase-figure">
        <img src="{{ asset('assets/motors/yamaha-aerox-155-cutout.png') }}" alt="Yamaha Aerox 155">
      </div>
    </aside>

    <article class="auth-panel">
      <div class="auth-mobile-head" aria-hidden="true">
        <a href="{{ route('home') }}" class="auth-mobile-back" aria-label="Kembali ke beranda">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 18 9 12l6-6"/></svg>
        </a>
      </div>

      <div class="auth-panel-header">
        <a href="{{ route('home') }}" class="auth-mobile-back" aria-label="Kembali ke beranda">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 18 9 12l6-6"/></svg>
        </a>
        <h1>Buat Akun Baru</h1>
        <p>Isi data di bawah untuk membuat akun dan mulai sewa motor favoritmu dengan lebih cepat.</p>
      </div>

      <form method="POST" action="{{ route('register.store') }}" class="auth-form">
        @csrf

        @if ($errors->any())
          <div class="auth-error">Periksa lagi form pendaftaran. Password harus minimal 8 karakter dan mengandung huruf serta angka.</div>
        @endif

        <div class="auth-field">
          <label for="register-name">Nama Lengkap</label>
          <input id="register-name" class="auth-input" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autocomplete="name">
          @error('name')<small class="auth-error">{{ $message }}</small>@enderror
        </div>

        <div class="auth-field">
          <label for="register-email">Email</label>
          <input id="register-email" class="auth-input" name="email" type="email" value="{{ old('email') }}" placeholder="Masukkan email aktif" required autocomplete="email">
          @error('email')<small class="auth-error">{{ $message }}</small>@enderror
        </div>

        <div class="auth-field">
          <label for="register-phone">Nomor Telepon</label>
          <input id="register-phone" class="auth-input" name="phone" type="tel" value="{{ old('phone') }}" placeholder="Contoh: 0812 3456 7890" required autocomplete="tel">
          @error('phone')<small class="auth-error">{{ $message }}</small>@enderror
        </div>

        <div class="auth-field">
          <label for="register-password">Kata Sandi</label>
          <div class="auth-input-wrap">
            <input id="register-password" class="auth-input" name="password" type="password" placeholder="Buat kata sandi" required autocomplete="new-password" minlength="8">
            <button type="button" class="auth-toggle" data-password-toggle="register-password" aria-label="Tampilkan kata sandi">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
          <small class="auth-hint">Minimal 8 karakter, wajib ada huruf dan angka.</small>
          @error('password')<small class="auth-error">{{ $message }}</small>@enderror
        </div>

        <div class="auth-field">
          <label for="register-password-confirmation">Konfirmasi Kata Sandi</label>
          <div class="auth-input-wrap">
            <input id="register-password-confirmation" class="auth-input" name="password_confirmation" type="password" placeholder="Ulangi kata sandi" required autocomplete="new-password" minlength="8">
            <button type="button" class="auth-toggle" data-password-toggle="register-password-confirmation" aria-label="Tampilkan konfirmasi kata sandi">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
          @error('password_confirmation')<small class="auth-error">{{ $message }}</small>@enderror
        </div>

        <label class="auth-check"><input type="checkbox" checked> <span>Saya setuju dengan <strong>Syarat</strong> dan <strong>Kebijakan Privasi</strong> MotoRent.</span></label>

        <button class="auth-submit" type="submit">Daftar</button>
      </form>

      <p class="auth-footnote">Sudah punya akun? <a href="{{ route('login') }}">Masuk sekarang</a></p>
    </article>
  </div>
</section>
@endsection

@push('scripts')
<script>
  (() => {
    document.querySelectorAll('[data-password-toggle]').forEach((button) => {
      button.addEventListener('click', () => {
        const input = document.getElementById(button.getAttribute('data-password-toggle'));
        if (!input) {
          return;
        }

        const nextType = input.type === 'password' ? 'text' : 'password';
        input.type = nextType;
        button.setAttribute('aria-label', nextType === 'password' ? 'Tampilkan kata sandi' : 'Sembunyikan kata sandi');
      });
    });
  })();
</script>
@endpush
