<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MotoRent - Sewa Motor Mudah</title>
  <link rel="icon" href="{{ asset('assets/logo-motorent.svg') }}" type="image/svg+xml">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  @vite(['resources/css/home.css', 'resources/js/home.js'])
</head>
<body class="home-screen min-w-[320px] bg-white font-['Plus_Jakarta_Sans'] text-[#111a33] antialiased">
  @php
    $pageWrap = 'mx-auto w-full max-w-[1680px] px-[clamp(16px,3vw,48px)]';
    $sectionHeader = 'mb-[11px] flex items-end justify-between gap-4';
    $sectionTitle = 'text-[19px] font-black tracking-[-0.35px] text-[#141d32]';
    $sectionLink = 'inline-flex items-center gap-2 text-xs font-black text-[#075cff] transition hover:translate-x-0.5';
  @endphp

  @include('partials.site-header')

  <main>
    <section class="home-hero {{ $pageWrap }} relative min-h-[420px] overflow-x-clip pt-[35px] max-[900px]:min-h-[333px] max-[900px]:pt-[30px]">
      <div aria-hidden="true" class="absolute right-[-88px] top-0 -z-10 h-[320px] w-[min(980px,60vw)] overflow-hidden rounded-bl-[220px] bg-[linear-gradient(145deg,#075cff_0%,#2d75ff_72%,#78a5ff_100%)] shadow-[inset_0_-44px_80px_rgba(1,56,203,0.26)] 2xl:right-[-36px] max-[1350px]:right-[-34px] max-[1180px]:inset-x-0 max-[1180px]:mx-auto max-[1180px]:w-[min(720px,100%)] max-[1180px]:rounded-[42px] max-[900px]:inset-x-[-16px] max-[900px]:top-[330px] max-[900px]:h-[225px] max-[900px]:w-auto max-[900px]:rounded-[36px]">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_82%_34%,rgba(255,255,255,0.25)_0_1px,transparent_2px)] bg-[length:22px_22px] opacity-60"></div>
        <div class="absolute left-[130px] bottom-0 h-[128px] w-[630px] opacity-20 max-[1350px]:left-auto max-[1350px]:right-[34px] max-[1350px]:w-[460px] max-[1180px]:left-1/2 max-[1180px]:right-auto max-[1180px]:w-[380px] max-[1180px]:-translate-x-1/2 max-[900px]:left-8 max-[900px]:w-[220px] max-[900px]:translate-x-0">
          <div class="absolute bottom-[54px] left-0 h-[74px] w-[42px] bg-[rgba(1,37,132,0.55)]"></div>
          <div class="absolute bottom-6 left-[58px] h-[104px] w-[54px] bg-[rgba(1,37,132,0.55)]"></div>
          <div class="absolute bottom-[62px] left-[130px] h-[66px] w-[52px] bg-[rgba(1,37,132,0.55)]"></div>
          <div class="absolute bottom-4 left-[212px] h-[112px] w-20 bg-[rgba(1,37,132,0.55)]"></div>
          <div class="absolute bottom-9 left-[322px] h-[92px] w-16 bg-[rgba(1,37,132,0.55)]"></div>
          <div class="absolute bottom-[9px] left-[420px] h-[119px] w-[78px] bg-[rgba(1,37,132,0.55)]"></div>
          <div class="absolute bottom-12 left-[530px] h-20 w-[58px] bg-[rgba(1,37,132,0.55)]"></div>
        </div>
        <div class="absolute left-[45px] top-[52px] h-[130px] w-[130px] rotate-[29deg] rounded-full border-l-[3px] border-[rgba(255,255,255,0.78)]"></div>
      </div>

      <div class="relative grid min-h-[330px] grid-cols-[minmax(0,1.02fr)_minmax(440px,0.98fr)] items-center gap-x-[56px] max-[1180px]:block max-[1180px]:min-h-[250px] max-[1180px]:text-center">
        <div>
          <h1 class="mb-[14px] max-w-[620px] text-[clamp(36px,4vw,66px)] font-black leading-[0.98] tracking-[-2.2px] text-[#111a33] max-[1180px]:mx-auto">
            Sewa Motor Jadi<br>
            Lebih <span class="text-[#075cff]">Mudah &amp; Cepat</span>
          </h1>
          <p class="mb-5 max-w-[620px] text-[clamp(16px,1.25vw,19px)] font-medium text-[#4f5b70] max-[1180px]:mx-auto">
            Temukan motor terbaik untuk setiap perjalananmu.<br>
            Proses cepat, aman, dan harga transparan.
          </p>
          <div class="flex flex-wrap gap-x-[38px] gap-y-3 text-sm font-bold text-[#48546a] max-[1180px]:justify-center">
            <span class="inline-flex items-center gap-[9px] whitespace-nowrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[18px] w-[18px] rounded-full bg-[#075cff] p-[3px] text-white stroke-[3]"><path d="M20 6 9 17l-5-5"/></svg> Banyak Pilihan Motor</span>
            <span class="inline-flex items-center gap-[9px] whitespace-nowrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[18px] w-[18px] rounded-full bg-[#075cff] p-[3px] text-white stroke-[3]"><path d="M20 6 9 17l-5-5"/></svg> Harga Terbaik</span>
            <span class="inline-flex items-center gap-[9px] whitespace-nowrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[18px] w-[18px] rounded-full bg-[#075cff] p-[3px] text-white stroke-[3]"><path d="M20 6 9 17l-5-5"/></svg> Proses Instan</span>
          </div>
        </div>

        <div class="pointer-events-none relative flex h-[320px] items-center justify-end overflow-hidden max-[1180px]:mt-8 max-[1180px]:h-[280px] max-[1180px]:justify-center">
          <img src="{{ asset('assets/motors/honda-vario-125-cutout.png') }}" alt="Skuter putih" class="w-[min(560px,38vw)] max-w-full scale-x-[-1] rotate-[-2deg] drop-shadow-[0_26px_22px_rgba(2,17,47,0.24)] max-[1180px]:w-[min(500px,88vw)] max-[900px]:w-[min(440px,95vw)]">
        </div>
      </div>

      <div class="relative z-[5] mt-8 flex flex-col gap-[40px] max-[1180px]:mt-[26px]">
        <div class="home-search-card grid min-h-[110px] grid-cols-[1.35fr_1.2fr_1.2fr_1.05fr_auto] items-center rounded-[20px] border border-[rgba(213,224,241,0.92)] bg-white/95 px-8 py-6 shadow-[0_18px_48px_rgba(13,40,86,0.14)] backdrop-blur max-[1350px]:grid-cols-4 max-[1350px]:gap-6 max-[1350px]:px-6 max-[1080px]:grid-cols-2 max-[1080px]:gap-6 max-[640px]:grid-cols-1 max-[640px]:px-4">
          <div class="flex min-w-0 items-center gap-[22px] pr-8 max-[1350px]:pr-0">
            <span class="grid h-[50px] w-[50px] shrink-0 place-items-center rounded-2xl bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
            <div class="min-w-0 flex-1">
              <label for="location" class="mb-1 block text-[13px] font-bold text-[#778197]">Lokasi</label>
              <div class="flex items-center gap-2.5">
                <select id="location" class="w-full min-w-0 appearance-none bg-transparent text-[15px] font-extrabold text-[#1c263d] outline-none">
                  <option>Jakarta, Indonesia</option>
                  <option>Yogyakarta</option>
                  <option>Bali</option>
                </select>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 shrink-0 text-[#647084]"><path d="m6 9 6 6 6-6"/></svg>
              </div>
            </div>
          </div>

          <div class="flex min-w-0 items-center gap-[22px] border-l border-[#dfe7f3] px-8 max-[1350px]:border-l-0 max-[1350px]:px-0">
            <span class="grid h-[50px] w-[50px] shrink-0 place-items-center rounded-2xl bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg></span>
            <div class="min-w-0 flex-1">
              <label for="startDate" class="mb-1 block text-[13px] font-bold text-[#778197]">Tanggal Mulai</label>
              <div class="flex items-center gap-2.5">
                <input id="startDate" type="text" placeholder="Pilih tanggal" onfocus="this.type='date'" class="w-full min-w-0 bg-transparent text-[15px] font-extrabold text-[#1c263d] outline-none placeholder:font-bold placeholder:text-[#8a95a8]">
              </div>
            </div>
          </div>

          <div class="flex min-w-0 items-center gap-[22px] border-l border-[#dfe7f3] px-8 max-[1350px]:border-l-0 max-[1350px]:px-0">
            <span class="grid h-[50px] w-[50px] shrink-0 place-items-center rounded-2xl bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg></span>
            <div class="min-w-0 flex-1">
              <label for="endDate" class="mb-1 block text-[13px] font-bold text-[#778197]">Tanggal Selesai</label>
              <div class="flex items-center gap-2.5">
                <input id="endDate" type="text" placeholder="Pilih tanggal" onfocus="this.type='date'" class="w-full min-w-0 bg-transparent text-[15px] font-extrabold text-[#1c263d] outline-none placeholder:font-bold placeholder:text-[#8a95a8]">
              </div>
            </div>
          </div>

          <div class="flex min-w-0 items-center gap-[22px] border-l border-[#dfe7f3] px-8 max-[1350px]:border-l-0 max-[1350px]:px-0">
            <span class="grid h-[50px] w-[50px] shrink-0 place-items-center rounded-2xl bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M7 17h7l3-8h3M9 10h5l-2 7M7 7h5"/><circle cx="7" cy="17" r="3"/><circle cx="18" cy="17" r="3"/></svg></span>
            <div class="min-w-0 flex-1">
              <label for="motorType" class="mb-1 block text-[13px] font-bold text-[#778197]">Jenis Motor</label>
              <div class="flex items-center gap-2.5">
                <select id="motorType" class="w-full min-w-0 appearance-none bg-transparent text-[15px] font-extrabold text-[#1c263d] outline-none">
                  <option>Semua Jenis</option>
                  <option>Matic</option>
                  <option>Sport</option>
                  <option>Naked</option>
                  <option>Trail</option>
                </select>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 shrink-0 text-[#647084]"><path d="m6 9 6 6 6-6"/></svg>
              </div>
            </div>
          </div>

          <button id="searchBtn" type="button" class="inline-flex min-h-[58px] items-center justify-center gap-2.5 rounded-xl bg-[linear-gradient(180deg,#1267ff,#0053ed)] px-6 text-base font-black text-white shadow-[0_16px_30px_rgba(7,92,255,0.22)] transition hover:-translate-y-0.5 hover:shadow-[0_18px_34px_rgba(7,92,255,0.26)] max-[1350px]:col-span-4 max-[1350px]:w-full max-[1080px]:col-span-2 max-[640px]:col-span-1">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            Cari Motor
          </button>
        </div>

        <div class="home-feature-card grid min-h-[94px] grid-cols-5 items-center rounded-[20px] border border-[rgba(213,224,241,0.95)] bg-white/98 px-8 py-6 shadow-[0_10px_24px_rgba(16,38,74,0.08)] max-[1350px]:grid-cols-3 max-[1350px]:gap-5 max-[1350px]:px-6 max-[960px]:grid-cols-2 max-[640px]:grid-cols-1 max-[640px]:px-4">
          <div class="flex min-h-[60px] min-w-0 items-center justify-center gap-[22px] border-r border-[#dfe7f3] pr-4 max-[1350px]:justify-start max-[1350px]:border-r-0 max-[1350px]:pr-0 max-[640px]:border-b max-[640px]:pb-5">
            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[21px] w-[21px]"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
            <div>
              <h4 class="mb-0.5 text-[13px] font-black text-[#172036]">Proses Cepat</h4>
              <p class="text-xs font-semibold text-[#788297]">Reservasi instan, tanpa ribet</p>
            </div>
          </div>
          <div class="flex min-h-[60px] min-w-0 items-center justify-center gap-[22px] border-r border-[#dfe7f3] px-4 max-[1350px]:justify-start max-[1350px]:border-r-0 max-[1350px]:px-0 max-[640px]:border-b max-[640px]:pb-5">
            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[21px] w-[21px]"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-5"/></svg></div>
            <div>
              <h4 class="mb-0.5 text-[13px] font-black text-[#172036]">Motor Terawat</h4>
              <p class="text-xs font-semibold text-[#788297]">Selalu bersih &amp; prima</p>
            </div>
          </div>
          <div class="flex min-h-[60px] min-w-0 items-center justify-center gap-[22px] border-r border-[#dfe7f3] px-4 max-[1350px]:justify-start max-[1350px]:border-r-0 max-[1350px]:px-0 max-[640px]:border-b max-[640px]:pb-5">
            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[21px] w-[21px]"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg></div>
            <div>
              <h4 class="mb-0.5 text-[13px] font-black text-[#172036]">Harga Transparan</h4>
              <p class="text-xs font-semibold text-[#788297]">Tanpa biaya tersembunyi</p>
            </div>
          </div>
          <div class="flex min-h-[60px] min-w-0 items-center justify-center gap-[22px] border-r border-[#dfe7f3] px-4 max-[1350px]:justify-start max-[1350px]:border-r-0 max-[1350px]:px-0 max-[640px]:border-b max-[640px]:pb-5">
            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[21px] w-[21px]"><path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg></div>
            <div>
              <h4 class="mb-0.5 text-[13px] font-black text-[#172036]">Bantuan 24/7</h4>
              <p class="text-xs font-semibold text-[#788297]">Kami siap membantu</p>
            </div>
          </div>
          <div class="flex min-h-[60px] min-w-0 items-center justify-center gap-[22px] pl-4 max-[1350px]:justify-start max-[1350px]:pl-0">
            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[21px] w-[21px]"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-5"/></svg></div>
            <div>
              <h4 class="mb-0.5 text-[13px] font-black text-[#172036]">Asuransi</h4>
              <p class="text-xs font-semibold text-[#788297]">Perlindungan selama sewa</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="home-brand-section {{ $pageWrap }} pt-16 max-[900px]:pt-[44px]">
      <div class="{{ $sectionHeader }}">
        <h2 class="{{ $sectionTitle }}">Pilihan Brand Terbaik</h2>
        <a href="#" class="{{ $sectionLink }}">Lihat semua brand <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[15px] w-[15px]"><path d="M5 12h14M13 5l7 7-7 7"/></svg></a>
      </div>
      <div id="brandStrip" class="grid grid-cols-5 gap-3 pb-2 min-[1500px]:grid-cols-6 max-[1350px]:grid-cols-4 max-[900px]:grid-cols-2 max-[640px]:grid-cols-1"></div>
    </section>

    <section class="home-type-section {{ $pageWrap }} pt-[22px]">
      <div class="{{ $sectionHeader }}">
        <h2 class="{{ $sectionTitle }}">Jenis Motor</h2>
        <a href="#" class="{{ $sectionLink }}">Lihat semua jenis <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[15px] w-[15px]"><path d="M5 12h14M13 5l7 7-7 7"/></svg></a>
      </div>
      <div id="typeStrip" class="grid grid-cols-5 gap-3 pb-2 min-[1500px]:grid-cols-6 max-[1350px]:grid-cols-4 max-[900px]:grid-cols-2 max-[640px]:grid-cols-1"></div>
    </section>

    <section class="home-recommend-section {{ $pageWrap }} pt-0" id="katalog">
      <div class="{{ $sectionHeader }}">
        <h2 class="relative pb-[9px] text-[19px] font-black tracking-[-0.35px] text-[#141d32] after:absolute after:bottom-0 after:left-0 after:h-[3px] after:w-7 after:rounded-full after:bg-[#075cff]">Rekomendasi Motor</h2>
        <a href="{{ route('motors.index') }}" class="{{ $sectionLink }}">Lihat semua motor <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[15px] w-[15px]"><path d="M5 12h14M13 5l7 7-7 7"/></svg></a>
      </div>
      <div id="motorGrid" class="home-motor-grid grid grid-cols-4 gap-6 min-[1500px]:grid-cols-5 max-[1350px]:grid-cols-3 max-[900px]:grid-cols-2 max-[640px]:grid-cols-1"></div>
      <div id="motorPagination" class="home-motor-pagination mt-4 hidden items-center justify-center gap-2"></div>
      <div class="mt-6 grid place-items-center">
        <button id="showAllBtn" type="button" class="inline-flex min-h-9 items-center justify-center gap-[9px] rounded-[10px] border border-[#dfe7f3] bg-white px-5 text-xs font-black text-[#075cff] shadow-[0_8px_18px_rgba(20,43,76,0.05)] transition hover:-translate-y-0.5 hover:border-[#93b4ff]">
          Lihat Semua Motor
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[15px] w-[15px]"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
        </button>
      </div>
    </section>

    <section class="{{ $pageWrap }} pb-[18px] pt-5" id="cara-sewa">
      <div class="grid grid-cols-[1.08fr_0.88fr_0.88fr] gap-6 max-[1350px]:grid-cols-2 max-[900px]:grid-cols-1">
        <div>
          <h2 class="mb-[13px] text-[19px] font-black tracking-[-0.35px] text-[#141d32]">Cara Sewa di MotoRent</h2>
          <div class="flex items-start justify-between gap-2 max-[640px]:flex-col max-[640px]:gap-[18px]">
            <div class="relative flex-1 text-center max-[640px]:w-full">
              <div class="absolute left-[19px] top-[-8px] grid h-[23px] w-[23px] place-items-center rounded-full border-[3px] border-white bg-[#075cff] text-[11px] font-black text-white">1</div>
              <div class="mx-auto mb-2.5 grid h-[53px] w-[53px] place-items-center rounded-[17px] border border-[#dfe7f3] bg-[#edf4ff] text-[#075cff] shadow-[0_8px_18px_rgba(20,43,76,0.06)]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[29px] w-[29px]"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg></div>
              <h4 class="mb-1 text-xs font-black text-[#202a3f]">Pilih Lokasi &amp; Tanggal</h4>
              <p class="text-[11px] font-semibold text-[#748095]">Tentukan lokasi dan tanggal sewa motor.</p>
            </div>

            <div class="mt-[29px] flex items-center gap-1.5 text-[#b8c5d8] max-[640px]:hidden">
              <span class="h-px w-[29px] border-t-2 border-dashed border-[#c9d5e8]"></span>
              <span class="h-px w-[29px] border-t-2 border-dashed border-[#c9d5e8]"></span>
              <span class="h-px w-[29px] border-t-2 border-dashed border-[#c9d5e8]"></span>
            </div>

            <div class="relative flex-1 text-center max-[640px]:w-full">
              <div class="absolute left-[19px] top-[-8px] grid h-[23px] w-[23px] place-items-center rounded-full border-[3px] border-white bg-[#075cff] text-[11px] font-black text-white">2</div>
              <div class="mx-auto mb-2.5 grid h-[53px] w-[53px] place-items-center rounded-[17px] border border-[#dfe7f3] bg-[#edf4ff] text-[#075cff] shadow-[0_8px_18px_rgba(20,43,76,0.06)]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[29px] w-[29px]"><circle cx="7" cy="17" r="3"/><circle cx="18" cy="17" r="3"/><path d="M7 17h7l3-8h3M9 10h5l-2 7M7 7h5"/></svg></div>
              <h4 class="mb-1 text-xs font-black text-[#202a3f]">Pilih Motor Favorit</h4>
              <p class="text-[11px] font-semibold text-[#748095]">Pilih motor yang sesuai kebutuhanmu.</p>
            </div>

            <div class="mt-[29px] flex items-center gap-1.5 text-[#b8c5d8] max-[640px]:hidden">
              <span class="h-px w-[29px] border-t-2 border-dashed border-[#c9d5e8]"></span>
              <span class="h-px w-[29px] border-t-2 border-dashed border-[#c9d5e8]"></span>
              <span class="h-px w-[29px] border-t-2 border-dashed border-[#c9d5e8]"></span>
            </div>

            <div class="relative flex-1 text-center max-[640px]:w-full">
              <div class="absolute left-[19px] top-[-8px] grid h-[23px] w-[23px] place-items-center rounded-full border-[3px] border-white bg-[#075cff] text-[11px] font-black text-white">3</div>
              <div class="mx-auto mb-2.5 grid h-[53px] w-[53px] place-items-center rounded-[17px] border border-[#dfe7f3] bg-[#edf4ff] text-[#075cff] shadow-[0_8px_18px_rgba(20,43,76,0.06)]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[29px] w-[29px]"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="m9 15 2 2 4-4"/></svg></div>
              <h4 class="mb-1 text-xs font-black text-[#202a3f]">Konfirmasi &amp; Jalan</h4>
              <p class="text-[11px] font-semibold text-[#748095]">Konfirmasi pesanan dan siap untuk berkendara!</p>
            </div>
          </div>
        </div>

        <div class="border-l border-[#dfe7f3] pl-9 max-[1350px]:border-l-0 max-[1350px]:pl-0">
          <h2 class="mb-[13px] text-[19px] font-black tracking-[-0.35px] text-[#141d32]">Layanan Tambahan</h2>
          <div class="grid grid-cols-4 gap-2.5 max-[900px]:grid-cols-2">
            <div class="flex min-h-[98px] flex-col items-center justify-center rounded-[13px] border border-[#dfe7f3] bg-white px-2 py-3 text-center shadow-[0_8px_18px_rgba(20,43,76,0.04)]">
              <div class="mb-2 grid h-[42px] w-[42px] place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg></div>
              <h4 class="mb-1 text-xs font-black text-[#202a3f]">Helm Premium</h4>
              <p class="text-[11px] font-semibold text-[#748095]">Bersih &amp; nyaman</p>
            </div>
            <div class="flex min-h-[98px] flex-col items-center justify-center rounded-[13px] border border-[#dfe7f3] bg-white px-2 py-3 text-center shadow-[0_8px_18px_rgba(20,43,76,0.04)]">
              <div class="mb-2 grid h-[42px] w-[42px] place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M20.38 3.46 16 2a8.9 8.9 0 0 1-5 3.18L7 6.46 2 9v13h20V9l-1.62-5.54ZM12 12v10"/></svg></div>
              <h4 class="mb-1 text-xs font-black text-[#202a3f]">Jaket Riding</h4>
              <p class="text-[11px] font-semibold text-[#748095]">Aman &amp; stylish</p>
            </div>
            <div class="flex min-h-[98px] flex-col items-center justify-center rounded-[13px] border border-[#dfe7f3] bg-white px-2 py-3 text-center shadow-[0_8px_18px_rgba(20,43,76,0.04)]">
              <div class="mb-2 grid h-[42px] w-[42px] place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="m21 16-9 5-9-5V8l9-5 9 5v8z"/><path d="m3.27 6.96 8.73 4.83 8.73-4.83"/><path d="M12 22V12"/></svg></div>
              <h4 class="mb-1 text-xs font-black text-[#202a3f]">Box Motor</h4>
              <p class="text-[11px] font-semibold text-[#748095]">Praktis &amp; aman</p>
            </div>
            <div class="flex min-h-[98px] flex-col items-center justify-center rounded-[13px] border border-[#dfe7f3] bg-white px-2 py-3 text-center shadow-[0_8px_18px_rgba(20,43,76,0.04)]">
              <div class="mb-2 grid h-[42px] w-[42px] place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg></div>
              <h4 class="mb-1 text-xs font-black text-[#202a3f]">Antar Jemput</h4>
              <p class="text-[11px] font-semibold text-[#748095]">Gratis antar motor</p>
            </div>
          </div>
        </div>

        <div id="tentang-kami" class="relative flex min-h-[148px] items-center overflow-hidden rounded-[13px] bg-[linear-gradient(135deg,#cfe1ff_0%,#eef5ff_58%,#d6e6ff_100%)] px-[23px] py-[18px] before:absolute before:right-[22px] before:top-[-18px] before:h-[66px] before:w-[66px] before:rounded-full before:bg-white/90 max-[1350px]:col-span-2 max-[900px]:col-span-1">
          <div class="relative z-10 max-w-[260px]">
            <h3 class="mb-[9px] text-[21px] font-black leading-[1.05] tracking-[-0.6px] text-[#12203a]">Mulai Perjalananmu<br>Bersama MotoRent</h3>
            <p class="mb-4 text-[11px] font-semibold text-[#637087]">Sewa motor sekarang dan nikmati<br>perjalanan yang bebas &amp; menyenangkan.</p>
            <a href="{{ route('motors.index') }}" class="inline-flex h-9 items-center gap-2 rounded-md bg-[linear-gradient(180deg,#1267ff,#0053ed)] px-[18px] text-xs font-black text-white shadow-[0_16px_30px_rgba(7,92,255,0.22)] transition hover:-translate-y-0.5 hover:shadow-[0_18px_34px_rgba(7,92,255,0.26)]">Cari Motor Sekarang <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[15px] w-[15px]"><path d="M5 12h14M13 5l7 7-7 7"/></svg></a>
          </div>
          <img src="{{ asset('assets/motors/honda-vario-125-cutout.png') }}" alt="Scooter hero" class="absolute bottom-[-58px] right-[-54px] w-[260px] scale-x-[-1] rotate-[-2deg] drop-shadow-[0_16px_16px_rgba(24,44,73,0.18)]">
        </div>
      </div>
    </section>

    <section class="{{ $pageWrap }} pb-[26px]" aria-label="Statistik MotoRent" id="bantuan">
      <div class="grid grid-cols-4 rounded-2xl border border-[rgba(213,224,241,0.95)] bg-white/95 shadow-[0_10px_24px_rgba(16,38,74,0.08)] max-[1350px]:grid-cols-2 max-[640px]:grid-cols-1">
        <div class="grid min-w-0 grid-cols-[44px_auto] grid-rows-[auto_auto] content-center justify-center gap-x-3 border-r border-[#dfe7f3] px-[18px] py-3 max-[640px]:border-b max-[640px]:border-r-0">
          <span class="row-span-2 grid h-[38px] w-[38px] place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[22px] w-[22px]"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
          <strong class="text-lg font-black leading-[1.05] text-[#172036]">10.000+</strong>
          <small class="text-[11px] font-bold text-[#748095]">Pelanggan Puas</small>
        </div>
        <div class="grid min-w-0 grid-cols-[44px_auto] grid-rows-[auto_auto] content-center justify-center gap-x-3 border-r border-[#dfe7f3] px-[18px] py-3 max-[1350px]:border-r-0 max-[1350px]:border-b max-[640px]:border-b">
          <span class="row-span-2 grid h-[38px] w-[38px] place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[22px] w-[22px]"><circle cx="7" cy="17" r="3"/><circle cx="18" cy="17" r="3"/><path d="M7 17h7l3-8h3M9 10h5l-2 7M7 7h5"/></svg></span>
          <strong class="text-lg font-black leading-[1.05] text-[#172036]">5.000+</strong>
          <small class="text-[11px] font-bold text-[#748095]">Motor Tersedia</small>
        </div>
        <div class="grid min-w-0 grid-cols-[44px_auto] grid-rows-[auto_auto] content-center justify-center gap-x-3 border-r border-[#dfe7f3] px-[18px] py-3 max-[640px]:border-b max-[640px]:border-r-0">
          <span class="row-span-2 grid h-[38px] w-[38px] place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[22px] w-[22px]"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
          <strong class="text-lg font-black leading-[1.05] text-[#172036]">50+</strong>
          <small class="text-[11px] font-bold text-[#748095]">Kota di Indonesia</small>
        </div>
        <div class="grid min-w-0 grid-cols-[44px_auto] grid-rows-[auto_auto] content-center justify-center gap-x-3 px-[18px] py-3">
          <span class="row-span-2 grid h-[38px] w-[38px] place-items-center rounded-full bg-[#edf4ff] text-[#075cff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[22px] w-[22px]"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></span>
          <strong class="text-lg font-black leading-[1.05] text-[#172036]">4.8/5</strong>
          <small class="text-[11px] font-bold text-[#748095]">Rating Pengguna</small>
        </div>
      </div>
    </section>
  </main>

  <div id="toast" role="status" aria-live="polite" class="pointer-events-none fixed left-1/2 bottom-8 z-[1000] min-w-[250px] -translate-x-1/2 translate-y-4 rounded-xl bg-[#15233b] px-[18px] py-[14px] text-center text-sm font-bold text-white opacity-0 shadow-[0_18px_48px_rgba(13,40,86,0.14)] transition duration-300 ease-out"></div>
  <script>
    window.MOTO_RENT_DATA = @json($homeData);
  </script>
</body>
</html>




