@extends('layouts.app')

@section('title', 'Lupa Password - MotoRent')

@section('content')
<section class="form-card">
  <h1>Lupa Password?</h1>
  <p>Masukkan email akunmu dan kami akan kirimkan link untuk reset password.</p>

  @if(session('status'))
    <div class="payment-flash" style="margin: 0 0 18px;">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('password.email') }}" class="stack-form">
    @csrf
    <label>Email<input name="email" type="email" value="{{ old('email') }}" required autofocus></label>
    @error('email')<small class="error-text">{{ $message }}</small>@enderror
    <button class="primary-btn" type="submit">Kirim Link Reset</button>
  </form>
  <p class="muted-link">Ingat password? <a href="{{ route('login') }}">Masuk</a></p>
</section>
@endsection
