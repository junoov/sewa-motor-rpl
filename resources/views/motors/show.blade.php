@extends('layouts.app')

@section('title', $motor->name.' - MotoRent')

@section('pageHeader')
<div class="detail-desktop-header">
  @include('partials.site-header')
</div>
@endsection

@section('content')
@php
  $resolveImageUrl = fn (string $src): string => str_starts_with($src, 'http://') || str_starts_with($src, 'https://') || str_starts_with($src, '/') ? $src : asset($src);
  $detailGalleries = [
    'honda-beat' => [
        ['src' => 'assets/motors/honda-beat-main-gallery-transparent.png', 'alt' => $motor->name.' tampak depan'],
        ['src' => 'assets/motors/honda-beat-side-gallery-transparent.png', 'alt' => $motor->name.' body samping'],
        ['src' => 'assets/motors/honda-beat-rear-gallery-transparent.png', 'alt' => $motor->name.' tampak belakang'],
        ['src' => 'assets/motors/honda-beat-front-right-gallery-transparent.png', 'alt' => $motor->name.' tampak sudut kanan'],
        ['src' => 'assets/motors/honda-beat-headlamp-gallery-transparent.png', 'alt' => 'Detail spion dan headlamp '.$motor->name],
      ],
    'honda-vario-125' => [
        ['src' => 'assets/motors/honda-vario-125-front-gallery-transparent.png', 'alt' => $motor->name.' tampak depan'],
        ['src' => 'assets/motors/honda-vario-125-side-gallery-transparent.png', 'alt' => $motor->name.' body samping'],
        ['src' => 'assets/motors/honda-vario-125-rear-gallery-transparent.png', 'alt' => $motor->name.' tampak belakang'],
        ['src' => $motor->image_url, 'alt' => $motor->name.' tampak katalog'],
        ['src' => 'assets/motors/honda-vario-125-mirror-headlamp-gallery-transparent.png', 'alt' => 'Detail spion dan headlamp '.$motor->name],
      ],
    'yamaha-aerox-155' => [
        ['src' => 'assets/motors/yamaha-aerox-155-main-gallery-transparent.png', 'alt' => $motor->name.' tampak depan'],
        ['src' => 'assets/motors/yamaha-aerox-155-side-gallery-transparent.png', 'alt' => $motor->name.' body samping'],
        ['src' => 'assets/motors/yamaha-aerox-155-rear-gallery-transparent.png', 'alt' => $motor->name.' tampak belakang'],
        ['src' => 'assets/motors/yamaha-aerox-155-front-right-gallery-transparent.png', 'alt' => $motor->name.' tampak sudut kanan'],
        ['src' => 'assets/motors/yamaha-aerox-155-headlamp-gallery-transparent.png', 'alt' => 'Detail spion dan headlamp '.$motor->name],
      ],
    'yamaha-nmax-155' => [
        ['src' => 'assets/motors/yamaha-nmax-155-main-gallery-transparent.png', 'alt' => $motor->name.' tampak depan'],
        ['src' => 'assets/motors/yamaha-nmax-155-side-gallery-transparent.png', 'alt' => $motor->name.' body samping'],
        ['src' => 'assets/motors/yamaha-nmax-155-rear-gallery-transparent.png', 'alt' => $motor->name.' tampak belakang'],
        ['src' => 'assets/motors/yamaha-nmax-155-front-right-gallery-transparent.png', 'alt' => $motor->name.' tampak sudut kanan'],
        ['src' => 'assets/motors/yamaha-nmax-155-headlamp-gallery-transparent.png', 'alt' => 'Detail spion dan headlamp '.$motor->name],
      ],
    'kawasaki-z250' => [
        ['src' => 'assets/motors/kawasaki-z250-main-gallery-transparent.png', 'alt' => $motor->name.' tampak depan'],
        ['src' => 'assets/motors/kawasaki-z250-side-gallery-transparent.png', 'alt' => $motor->name.' body samping'],
        ['src' => 'assets/motors/kawasaki-z250-rear-gallery-transparent.png', 'alt' => $motor->name.' tampak belakang'],
        ['src' => 'assets/motors/kawasaki-z250-front-right-gallery-transparent.png', 'alt' => $motor->name.' tampak sudut kanan'],
        ['src' => 'assets/motors/kawasaki-z250-headlamp-gallery-transparent.png', 'alt' => 'Detail lampu dan setang '.$motor->name],
      ],
    'kawasaki-klx' => [
        ['src' => 'assets/motors/kawasaki-klx-main-gallery-transparent.png', 'alt' => $motor->name.' tampak depan'],
        ['src' => 'assets/motors/kawasaki-klx-side-gallery-transparent.png', 'alt' => $motor->name.' body samping'],
        ['src' => 'assets/motors/kawasaki-klx-rear-gallery-transparent.png', 'alt' => $motor->name.' tampak belakang'],
        ['src' => 'assets/motors/kawasaki-klx-front-right-gallery-transparent.png', 'alt' => $motor->name.' tampak sudut kanan'],
      ],
    'vespa-sprint' => [
        ['src' => 'assets/motors/vespa-sprint-main-gallery-transparent.png', 'alt' => $motor->name.' tanpa background'],
        ['src' => 'assets/motors/vespa-sprint-alt-1-gallery-transparent.png', 'alt' => $motor->name.' tampak katalog'],
        ['src' => 'assets/motors/vespa-sprint-alt-2-gallery-transparent.png', 'alt' => $motor->name.' tampak produk'],
        ['src' => 'assets/motors/vespa-sprint-alt-3-gallery-transparent.png', 'alt' => $motor->name.' tampak utuh'],
        ['src' => 'assets/motors/vespa-sprint-alt-4-gallery-transparent.png', 'alt' => $motor->name.' tampak galeri'],
      ],
    'benelli-imperiale' => [
        ['src' => 'assets/motors/benelli-imperiale-main-gallery-transparent.png', 'alt' => $motor->name.' tampak depan'],
        ['src' => 'assets/motors/benelli-imperiale-side-gallery-transparent.png', 'alt' => $motor->name.' body samping'],
        ['src' => 'assets/motors/benelli-imperiale-rear-gallery-transparent.png', 'alt' => $motor->name.' tampak belakang'],
        ['src' => 'assets/motors/benelli-imperiale-front-right-gallery-transparent.png', 'alt' => $motor->name.' tampak sudut kanan'],
        ['src' => 'assets/motors/benelli-imperiale-headlamp-gallery-transparent.png', 'alt' => 'Detail lampu dan setang '.$motor->name],
      ],
  ];
  $gallery = $detailGalleries[$motor->slug] ?? [
      ['src' => $motor->image_url, 'alt' => $motor->name],
      ['src' => $motor->image_url, 'alt' => $motor->name.' tampak samping'],
      ['src' => $motor->image_url, 'alt' => $motor->name.' tampak belakang'],
    ];
  $detailProfiles = [
    'honda-vario-125' => [
      'description' => 'Honda Vario 125 adalah skutik matic 125 cc yang irit, responsif, dan nyaman untuk perjalanan harian. Mesin eSP berpendingin cairan dengan sistem injeksi PGM-FI membuat performanya halus, efisien, dan cocok dipakai di jalan kota maupun rute jarak menengah.',
      'summary' => [
        ['label' => 'Tahun', 'value' => $motor->year],
        ['label' => 'Kapasitas', 'value' => '2 Orang'],
        ['label' => 'Bahan Bakar', 'value' => 'Bensin'],
        ['label' => 'Bagasi', 'value' => '18 Liter'],
      ],
      'specs' => [
        ['label' => 'Tipe Mesin', 'value' => 'eSP, 4 Langkah, SOHC'],
        ['label' => 'Sistem Pendingin', 'value' => 'Pendingin Cairan'],
        ['label' => 'Kapasitas Mesin', 'value' => '124,8 cc'],
        ['label' => 'Transmisi', 'value' => 'Otomatis V-Matic'],
        ['label' => 'Daya Maksimum', 'value' => '8,2 kW / 8.500 rpm'],
        ['label' => 'Kapasitas Tangki', 'value' => '5,5 Liter'],
        ['label' => 'Torsi Maksimum', 'value' => '10,8 Nm / 5.000 rpm'],
        ['label' => 'Berat', 'value' => '112 kg'],
      ],
    ],
    'vespa-sprint' => [
      'description' => 'Vespa Sprint adalah skuter klasik modern dengan karakter premium, bodi baja yang kokoh, dan mesin i-get yang halus untuk city ride. Posisi berkendaranya santai, tampilannya elegan, dan cocok untuk perjalanan singkat di area wisata maupun kebutuhan harian yang ingin terasa lebih stylish.',
      'summary' => [
        ['label' => 'Tahun', 'value' => $motor->year],
        ['label' => 'Kapasitas', 'value' => '2 Orang'],
        ['label' => 'Bahan Bakar', 'value' => 'Bensin'],
        ['label' => 'Tangki', 'value' => '8 Liter'],
      ],
      'specs' => [
        ['label' => 'Tipe Mesin', 'value' => 'i-get, 4 Langkah, 3 Katup'],
        ['label' => 'Sistem Pendingin', 'value' => 'Forced Air'],
        ['label' => 'Kapasitas Mesin', 'value' => 'Kelas 150 cc'],
        ['label' => 'Transmisi', 'value' => 'CVT Otomatis'],
        ['label' => 'Sistem Bahan Bakar', 'value' => 'Electronic Injection'],
        ['label' => 'Kapasitas Tangki', 'value' => '8 Liter'],
        ['label' => 'Rem Depan', 'value' => 'Disc Brake ABS'],
        ['label' => 'Ban', 'value' => 'Tubeless 12 inci'],
      ],
    ],
  ];
  $defaultProfile = [
    'description' => $motor->description.' Motor ini disiapkan dalam kondisi terawat, bersih, dan nyaman untuk kebutuhan perjalanan harian maupun liburan singkat.',
    'summary' => [
      ['label' => 'Tahun', 'value' => $motor->year],
      ['label' => 'Kapasitas', 'value' => '2 Orang'],
      ['label' => 'Bahan Bakar', 'value' => 'Bensin'],
      ['label' => 'Transmisi', 'value' => $motor->transmission],
    ],
    'specs' => [
      ['label' => 'Kapasitas Mesin', 'value' => $motor->cc.' cc'],
      ['label' => 'Transmisi', 'value' => $motor->transmission],
      ['label' => 'Tahun', 'value' => $motor->year],
      ['label' => 'Bahan Bakar', 'value' => 'Bensin'],
      ['label' => 'Kapasitas', 'value' => '2 Orang'],
      ['label' => 'Status Unit', 'value' => ucfirst($motor->status)],
    ],
  ];
  $detailProfile = $detailProfiles[$motor->slug] ?? $defaultProfile;
@endphp

<section class="desktop-detail-section" aria-label="Detail motor {{ $motor->name }}">
  <nav class="detail-breadcrumb" aria-label="Breadcrumb">
    <a href="{{ route('home') }}">Beranda</a>
    <span>›</span>
    <a href="{{ route('motors.index') }}">Cari Motor</a>
    <span>›</span>
    <strong>{{ $motor->name }}</strong>
  </nav>

  <div class="detail-product-layout">
    <article class="detail-gallery-card">
      <div class="detail-gallery-count" id="detailImageCount">1 / {{ count($gallery) }}</div>

      <div class="mobile-detail-topbar">
        <a href="{{ route('motors.index') }}" class="mobile-detail-circle-btn" aria-label="Kembali ke daftar motor">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="mobile-detail-topbar__title">Detail Motor</div>
        <div class="mobile-detail-topbar-actions">
          <button type="button" class="mobile-detail-circle-btn" data-share="{{ $motor->name }}" data-share-url="{{ url()->current() }}" aria-label="Bagikan">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="m16 6 4-4"/><path d="m16 6-4-4"/><path d="M16 6v9"/><path d="M4 12h16"/></svg>
          </button>
          @auth
            <button type="button" class="mobile-detail-circle-btn detail-wishlist-btn {{ $isWishlisted ? 'is-active' : '' }}" data-wishlist-slug="{{ $motor->slug }}" aria-label="Simpan ke favorit">
              <svg viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
            </button>
          @else
            <a href="{{ route('login') }}" class="mobile-detail-circle-btn detail-wishlist-btn" aria-label="Login untuk simpan favorit">
              <svg viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
            </a>
          @endauth
        </div>
      </div>

      <div class="gallery-stage">
        <button class="gallery-nav prev" type="button" aria-label="Gambar sebelumnya" @if(count($gallery) < 2) hidden @endif>
          <svg viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></svg>
        </button>
        <img id="detailMainImage" src="{{ $resolveImageUrl($gallery[0]['src']) }}" alt="{{ $gallery[0]['alt'] }}">
        <button class="gallery-nav next" type="button" aria-label="Gambar berikutnya" @if(count($gallery) < 2) hidden @endif>
          <svg viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></svg>
        </button>
      </div>
      <div class="gallery-thumbs {{ count($gallery) === 1 ? 'is-single' : '' }}" aria-label="Galeri {{ $motor->name }}">
        @foreach($gallery as $image)
          <button class="{{ $loop->first ? 'active' : '' }}" type="button" data-gallery-image="{{ $resolveImageUrl($image['src']) }}" data-gallery-alt="{{ $image['alt'] }}">
            <img src="{{ $resolveImageUrl($image['src']) }}" alt="{{ $image['alt'] }}">
          </button>
        @endforeach
      </div>
    </article>

    <aside class="detail-info-panel">
      <div class="detail-title-row">
        <h1>{{ $motor->name }}</h1>
        @auth
        <button type="button" class="detail-wishlist-btn {{ $isWishlisted ? 'is-active' : '' }}" data-wishlist-slug="{{ $motor->slug }}" aria-label="Simpan ke favorit">
          <svg viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
        </button>
        @else
        <a href="{{ route('login') }}" class="detail-wishlist-btn" aria-label="Login untuk simpan favorit">
          <svg viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
        </a>
        @endauth
      </div>
      <div class="detail-meta-row">
        <span class="detail-rating-row">
          <svg viewBox="0 0 24 24"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          {{ $motor->rating }} ({{ $motor->reviews_count }}+ review)
        </span>
      </div>

      <div class="desktop-detail-pills">
        <span><svg viewBox="0 0 24 24"><path d="M4 13a8 8 0 0 1 16 0v3a2 2 0 0 1-2 2h-3.5"/><path d="M4 13v3a2 2 0 0 0 2 2h3"/><path d="M9 18v-3h6v3"/><path d="M7 13h10"/></svg>2 Helm</span>
        <span><svg viewBox="0 0 24 24"><path d="M8 9h8v7H8z"/><path d="M5 12H3"/><path d="M21 12h-2"/><path d="M10 6V4"/><path d="M14 6V4"/><path d="M7 16l-2 3"/><path d="M17 16l2 3"/></svg>{{ $motor->cc }} cc</span>
        <span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="7"/><path d="M12 5v3"/><path d="M12 16v3"/><path d="M5 12h3"/><path d="M16 12h3"/><circle cx="12" cy="12" r="2"/></svg>{{ $motor->transmission }}</span>
      </div>

      <p class="detail-lead">{{ $detailProfile['description'] }}</p>

      <div class="booking-panel">
        <div class="booking-price"><strong>Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}</strong><span>/hari</span></div>
        <p class="booking-panel-note">Pilih tanggal sewa dan lokasi pengambilan di langkah booking berikutnya.</p>
        <a class="desktop-book-btn" href="{{ route('bookings.create', $motor) }}">Booking Sekarang</a>
      </div>
    </aside>
  </div>

  <section class="detail-extra-card" aria-label="Informasi lengkap {{ $motor->name }}">
    <article class="detail-description-card">
      <h2>Deskripsi</h2>
      <p>{{ $detailProfile['description'] }}</p>
    </article>

    <div class="detail-spec-block">
      <div class="detail-spec-heading">
        <h2>Spesifikasi</h2>
        <button type="button" class="detail-spec-toggle" data-toggle-specs>Lihat semua</button>
      </div>
      <div class="detail-stats-strip" aria-label="Spesifikasi ringkas {{ $motor->name }}">
        @foreach($detailProfile['summary'] as $item)
          @php
            $icon = match(strtolower($item['label'])) {
              'tahun' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>',
              'kapasitas' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
              'bahan bakar' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 22h5a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-3"/><path d="M14 4h-3"/><path d="M3 6a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M14 13h1"/><path d="M7 15h.01"/></svg>',
              'bagasi' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>',
              'transmisi' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>',
              'tangki' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 22h5a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-3"/><path d="M14 4h-3"/><path d="M3 6a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M14 13h1"/><path d="M7 15h.01"/></svg>',
              default => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>',
            };
          @endphp
          <article>
            {!! $icon !!}
            <span>{{ $item['label'] }}<strong>{{ $item['value'] }}</strong></span>
          </article>
        @endforeach
      </div>
      <dl class="detail-spec-list" data-spec-list>
        @foreach($detailProfile['specs'] as $spec)
          <div>
            <dt>{{ $spec['label'] }}</dt>
            <dd>{{ $spec['value'] }}</dd>
          </div>
        @endforeach
      </dl>
    </div>
  </section>

  <section class="detail-calendar-card">
    <h2>Ketersediaan Motor</h2>
    <p>Tanggal berwarna merah menandakan motor sedang disewa. Tanggal hijau tersedia untuk booking.</p>
    <div class="detail-calendar-wrap" data-calendar></div>
    <div class="detail-calendar-legend">
      <span><span class="dot is-available"></span> Tersedia</span>
      <span><span class="dot is-booked"></span> Tidak Tersedia</span>
    </div>
  </section>

  <div class="mobile-detail-bottombar">
    <div class="mobile-detail-bottombar-left">
      <small>Harga Sewa</small>
      <div class="mobile-detail-bottombar-price">
        <span>Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}</span>
        <small>/hari</small>
      </div>
    </div>
    <a href="{{ route('bookings.create', $motor) }}" class="mobile-detail-bottombar-btn">Booking Sekarang</a>
  </div>

@push('scripts')
<script>
  const bookedDates = @json($bookedDates);

  (() => {
    const calendarEl = document.querySelector('[data-calendar]');
    if (!calendarEl) return;

    const today = new Date();
    const currentMonth = new Date(today.getFullYear(), today.getMonth(), 1);
    const monthsToShow = 1;

    const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    const dayNames = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];

    for (let m = 0; m < monthsToShow; m++) {
      const monthDate = new Date(currentMonth.getFullYear(), currentMonth.getMonth() + m, 1);
      const year = monthDate.getFullYear();
      const month = monthDate.getMonth();
      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      const wrap = document.createElement('div');
      wrap.className = 'detail-calendar-month';
      wrap.innerHTML = `
        <div class="detail-calendar-month-title">${monthNames[month]} ${year}</div>
        <div class="detail-calendar-grid">
          ${dayNames.map(d => `<div class="detail-calendar-dayname">${d}</div>`).join('')}
          ${Array.from({length: firstDay}, () => `<div></div>`).join('')}
          ${Array.from({length: daysInMonth}, (_, i) => {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(i + 1).padStart(2, '0')}`;
            const isBooked = bookedDates.includes(dateStr);
            const isPast = dateStr < today.toISOString().slice(0, 10);
            const cls = isPast ? 'is-past' : (isBooked ? 'is-booked' : 'is-available');
            return `<div class="detail-calendar-day ${cls}">${i + 1}</div>`;
          }).join('')}
        </div>
      `;
      calendarEl.appendChild(wrap);
    }
  })();

  document.addEventListener('DOMContentLoaded', () => {
    const wishlistBtns = document.querySelectorAll('[data-wishlist-slug]');
    wishlistBtns.forEach((btn) => {
      btn.addEventListener('click', async (e) => {
        e.preventDefault();
        const slug = btn.dataset.wishlistSlug;
        try {
          const res = await fetch(`/wishlist/${slug}`, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
              'Accept': 'application/json',
            },
          });
          const data = await res.json();
          wishlistBtns.forEach((b) => {
            if (data.status === 'added') {
              b.classList.add('is-active');
            } else if (data.status === 'removed') {
              b.classList.remove('is-active');
            }
          });
        } catch (err) {
          console.error(err);
        }
      });
    });

    document.querySelectorAll('[data-share]').forEach((btn) => {
      btn.addEventListener('click', async () => {
        const title = btn.dataset.share;
        const url = btn.dataset.shareUrl || window.location.href;
        if (navigator.share) {
          try { await navigator.share({ title, url }); } catch {}
        } else {
          try { await navigator.clipboard.writeText(url); btn.style.transform = 'scale(0.95)'; setTimeout(() => btn.style.transform = '', 150); } catch {}
        }
      });
    });

    const specToggle = document.querySelector('[data-toggle-specs]');
    const specList = document.querySelector('[data-spec-list]');
    if (specToggle && specList) {
      specToggle.addEventListener('click', () => {
        specList.classList.toggle('is-expanded');
        specToggle.textContent = specList.classList.contains('is-expanded') ? 'Sembunyikan' : 'Lihat semua';
      });
    }

    const mainImage = document.querySelector('#detailMainImage');
    const thumbs = Array.from(document.querySelectorAll('[data-gallery-image]'));

    let activeIndex = thumbs.findIndex((thumb) => thumb.classList.contains('active'));
    activeIndex = activeIndex >= 0 ? activeIndex : 0;
    const count = document.querySelector('#detailImageCount');

    const setActive = (index) => {
      activeIndex = (index + thumbs.length) % thumbs.length;
      const thumb = thumbs[activeIndex];
      thumbs.forEach((item) => item.classList.toggle('active', item === thumb));
      mainImage.src = thumb.dataset.galleryImage;
      mainImage.alt = thumb.dataset.galleryAlt || '{{ $motor->name }}';
      if (count) count.textContent = `${activeIndex + 1} / ${thumbs.length}`;
    };

    thumbs.forEach((thumb, index) => {
      thumb.addEventListener('click', () => {
        setActive(index);
      });
    });

    document.querySelector('.gallery-nav.prev')?.addEventListener('click', () => setActive(activeIndex - 1));
    document.querySelector('.gallery-nav.next')?.addEventListener('click', () => setActive(activeIndex + 1));
    setActive(activeIndex);

  });
</script>
@endpush
@endsection
