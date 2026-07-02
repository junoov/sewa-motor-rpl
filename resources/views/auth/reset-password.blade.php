@extends('layouts.app')

@section('title', 'Reset Password - MotoRent')

@section('content')
<section class="form-card">
  <h1>Reset Password</h1>
  <p>Buat password baru untuk akunmu.</p>

  <form method="POST" action="{{ route('password.update') }}" class="stack-form">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <label>Email<input type="email" value="{{ $email }}" disabled></label>

    <label>Password Baru<input name="password" type="password" required></label>
    @error('password')<small class="error-text">{{ $message }}</small>@enderror

    <label>Konfirmasi Password Baru<input name="password_confirmation" type="password" required></label>

    <button class="primary-btn" type="submit">Simpan Password Baru</button>
  </form>
  <p class="muted-link"><a href="{{ route('login') }}">Kembali ke Login</a></p>
</section>
@endsection
