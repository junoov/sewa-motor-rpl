@extends('layouts.app')

@section('title', 'Masuk - MotoRent')

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

  .auth-showcase-figure {
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    min-height: 280px;
    margin-top: 30px;
  }

  .auth-showcase-figure::before {
    content: "";
    position: absolute;
    left: 50%;
    bottom: 18px;
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
    width: min(100%, 360px);
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

  .auth-status {
    margin-top: 16px;
    padding: 13px 15px;
    border-radius: 16px;
    background: rgba(17, 185, 129, 0.1);
    color: #047857;
    font-size: 0.92rem;
    font-weight: 700;
  }

  .auth-form {
    display: grid;
    gap: 16px;
    margin-top: 30px;
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
    height: 52px;
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
    top: 6px;
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

  .auth-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    margin-top: -2px;
  }

  .auth-check {
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .auth-check input {
    width: 16px;
    height: 16px;
    accent-color: #075cff;
  }

  .auth-link {
    color: #075cff;
    font-size: 0.84rem;
    font-weight: 800;
    text-decoration: none;
  }

  .auth-submit {
    width: 100%;
    height: 52px;
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

  .auth-divider {
    position: relative;
    margin: 12px 0 2px;
    text-align: center;
    color: #94a0b5;
    font-size: 0.82rem;
    font-weight: 700;
  }

  .auth-divider::before {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    height: 1px;
    background: #e9eef6;
  }

  .auth-divider span {
    position: relative;
    padding: 0 12px;
    background: #ffffff;
  }

  .auth-socials {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
  }

  .auth-social {
    min-height: 46px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    border: 1px solid #dfe7f4;
    border-radius: 14px;
    background: #ffffff;
    color: #334155;
    font-size: 0.92rem;
    font-weight: 700;
    opacity: 0.72;
    cursor: not-allowed;
  }

  .auth-social img,
  .auth-social svg {
    width: 18px;
    height: 18px;
  }

  .auth-social svg {
    fill: currentColor;
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

    .auth-row {
      align-items: flex-start;
      flex-direction: column;
    }

    .auth-socials {
      grid-template-columns: 1fr 1fr;
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

      <div class="auth-showcase-copy">
        <h2>Sewa Motor Mudah, Cepat &amp; Terpercaya</h2>
        <p>Masuk untuk melanjutkan booking, melihat riwayat sewa, dan mengelola perjalananmu lebih cepat.</p>
      </div>

      <div class="auth-showcase-figure">
        <img src="{{ asset('assets/motors/honda-vario-125-cutout.png') }}" alt="Honda Vario 125">
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
        <h1>Selamat Datang Kembali 👋</h1>
        <p>Masuk untuk melanjutkan ke akun Anda dan lanjutkan proses penyewaan motor dengan lebih cepat.</p>
      </div>

      @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
      @endif

      <form method="POST" action="{{ route('login.store') }}" class="auth-form">
        @csrf

        <div class="auth-field">
          <label for="login-email">Email atau Nomor Telepon</label>
          <input id="login-email" class="auth-input" name="email" type="email" value="{{ old('email') }}" placeholder="Masukkan email atau nomor telepon" required autofocus autocomplete="email">
          @error('email')<small class="auth-error">{{ $message }}</small>@enderror
        </div>

        <div class="auth-field">
          <label for="login-password">Kata Sandi</label>
          <div class="auth-input-wrap">
            <input id="login-password" class="auth-input" name="password" type="password" placeholder="Masukkan kata sandi" required autocomplete="current-password">
            <button type="button" class="auth-toggle" data-password-toggle="login-password" aria-label="Tampilkan kata sandi">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
          @error('password')<small class="auth-error">{{ $message }}</small>@enderror
        </div>

        <div class="auth-row">
          <label class="auth-check"><input name="remember" type="checkbox" value="1"> <span>Ingat saya</span></label>
          <a href="{{ route('password.request') }}" class="auth-link">Lupa kata sandi?</a>
        </div>

        <button class="auth-submit" type="submit">Masuk</button>

        <div class="auth-divider"><span>atau masuk dengan</span></div>

        <div class="auth-socials" aria-label="Metode login alternatif">
          <button type="button" class="auth-social" aria-disabled="true">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12.23c0-.82-.07-1.44-.22-2.09H12v3.95h5.17c-.1.98-.66 2.46-1.9 3.45l-.02.13 2.99 2.27.21.02C20.38 18.2 21 15.54 21 12.23Z"/><path d="M12 21c2.52 0 4.64-.81 6.19-2.21l-3.18-2.42c-.85.58-1.99.99-3.01.99-2.46 0-4.55-1.6-5.3-3.8l-.13.01-3.11 2.35-.04.12C4.96 18.94 8.2 21 12 21Z"/><path d="M6.7 13.56A5.94 5.94 0 0 1 6.39 12c0-.54.11-1.06.29-1.56l-.01-.15-3.16-2.39-.1.05A8.8 8.8 0 0 0 3 12c0 1.43.34 2.78.95 3.96l2.75-2.4Z"/><path d="M12 6.64c1.29 0 2.41.54 3.14 1.19l2.29-2.2C16.52 4.8 14.52 4 12 4 8.2 4 4.96 6.06 3.41 9.04l3.27 2.49c.76-2.2 2.85-3.89 5.32-3.89Z"/></svg>
            <span>Google</span>
          </button>
          <button type="button" class="auth-social" aria-disabled="true">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M16.365 1.43c0 1.14-.468 2.255-1.245 3.06-.86.89-2.047 1.407-3.19 1.32-.145-1.09.418-2.255 1.183-3.024.84-.873 2.18-1.5 3.252-1.356zM20.704 17.455c-.61 1.35-.9 1.95-1.683 3.148-1.09 1.67-2.632 3.753-4.54 3.77-1.698.018-2.135-1.108-4.44-1.095-2.304.013-2.783 1.116-4.48 1.099-1.91-.019-3.37-1.9-4.46-3.57C-2.014 14.84-.638 5.7 4.64 5.44c1.29-.063 2.507.89 3.29.89.806 0 2.316-1.1 3.905-.94.665.028 2.535.267 3.736 2.023-3.245 1.78-2.72 6.41.133 8.042z"/></svg>
            <span>Apple</span>
          </button>
        </div>
      </form>

      <p class="auth-footnote">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
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
