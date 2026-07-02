@extends('layouts.app')

@section('title', 'Invoice '.$booking->order_number.' - MotoRent')

@section('content')
@php
  $motor = $booking->motor;
  $location = $booking->pickupLocation;
@endphp

<section class="payment-page">
  <div class="payment-title-row">
    <a href="{{ route('bookings.show', $booking) }}" class="payment-back" aria-label="Kembali">
      <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    </a>
    <div>
      <h1>Invoice</h1>
      <p class="payment-subtitle">{{ $booking->order_number }}</p>
    </div>
  </div>

  <div class="invoice-card">
    <div class="invoice-header">
      <div>
        <h2>MotoRent</h2>
        <p>Platform Sewa Motor Online</p>
      </div>
      <div class="invoice-meta">
        <span><small>No. Invoice</small><b>{{ $booking->order_number }}</b></span>
        <span><small>Tanggal</small><b>{{ now()->translatedFormat('d F Y') }}</b></span>
        <span><small>Status</small><b>{{ ucfirst($booking->status) }}</b></span>
      </div>
    </div>

    <div class="invoice-divider"></div>

    <div class="invoice-parties">
      <div>
        <small>Dari</small>
        <b>PT MotoRent Indonesia</b>
        <p>Jl. Sudirman No. 123, Jakarta</p>
        <p>contact@motorent.id</p>
      </div>
      <div>
        <small>Kepada</small>
        <b>{{ $booking->user->name }}</b>
        <p>{{ $booking->user->email }}</p>
        <p>{{ $booking->user->phone }}</p>
      </div>
    </div>

    <div class="invoice-divider"></div>

    <div class="invoice-details">
      <h3>Detail Pesanan</h3>
      <table class="invoice-table">
        <thead>
          <tr>
            <th>Motor</th>
            <th>Durasi</th>
            <th>Harga/Hari</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <strong>{{ $motor->name }}</strong>
              <span>{{ $motor->brand->name }} · {{ $motor->cc }}cc · {{ $motor->transmission }}</span>
            </td>
            <td>{{ $booking->duration_days }} hari</td>
            <td>Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</td>
          </tr>
        </tbody>
      </table>

      <div class="invoice-summary">
        <div><span>Subtotal</span><b>Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</b></div>
        <div><span>Biaya Layanan</span><b>Rp {{ number_format($booking->deposit_amount, 0, ',', '.') }}</b></div>
        <div class="invoice-total"><span>Total</span><b>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</b></div>
      </div>
    </div>

    <div class="invoice-divider"></div>

    <div class="invoice-info">
      <div>
        <small>Lokasi Pengambilan</small>
        <b>{{ $location->name }}</b>
        <p>{{ $location->address }}, {{ $location->city }}</p>
      </div>
      <div>
        <small>Tanggal Sewa</small>
        <b>{{ $booking->start_date->translatedFormat('d F Y') }} – {{ $booking->end_date->translatedFormat('d F Y') }}</b>
      </div>
      @if($methodData)
      <div>
        <small>Metode Pembayaran</small>
        <b>{{ $methodData['name'] }}</b>
      </div>
      @endif
    </div>

    <div class="invoice-actions">
      <button onclick="window.print()" class="payment-confirm-btn">
        <svg viewBox="0 0 24 24"><path d="M6 9V3h12v6"/><path d="M6 15h12v6H6z"/><path d="M18 9H6a3 3 0 0 0-3 3v3h18v-3a3 3 0 0 0-3-3Z"/></svg>
        Cetak Invoice
      </button>
    </div>
  </div>
</section>
@endsection

@push('head')
<style>
  @media print {
    .motorrent-header,
    .payment-back,
    .invoice-actions {
      display: none !important;
    }
    .invoice-card {
      box-shadow: none !important;
      border: none !important;
    }
  }
</style>
@endpush
