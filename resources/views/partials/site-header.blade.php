<header class="motorrent-header">
  <div class="motorrent-header__inner">
    <button type="button" aria-label="Buka menu navigasi" aria-controls="mobile-navigation" aria-expanded="false" class="motorrent-header__menu" data-mobile-menu-toggle>
      <svg viewBox="0 0 24 24" class="motorrent-header__icon motorrent-header__icon--menu" aria-hidden="true">
        <path d="M5 7h14"/>
        <path d="M5 12h14"/>
        <path d="M5 17h14"/>
      </svg>
      <svg viewBox="0 0 24 24" class="motorrent-header__icon motorrent-header__icon--close" aria-hidden="true">
        <path d="M6 6l12 12"/>
        <path d="M18 6 6 18"/>
      </svg>
    </button>

    <a href="{{ route('home') }}" aria-label="MotoRent" class="motorrent-header__brand">
      <svg viewBox="0 0 52 44" class="motorrent-header__logo" aria-hidden="true">
        <circle cx="15" cy="31" r="6.7"/>
        <circle cx="41" cy="31" r="6.7"/>
        <path d="M15 31h8.5l6-15.8h7.6L41 31"/>
        <path d="M24.5 31h10.2l-7.4-12.3M34.8 15.2h8.4M20.8 17h8.1"/>
        <path d="M13 19h9.8"/>
        <path d="M25.5 8.5h8.8"/>
      </svg>
      <span class="motorrent-header__brand-text">
        <span class="motorrent-header__name">MotoRent</span>
        <span class="motorrent-header__tagline">Sewa motor mudah &amp; terpercaya</span>
      </span>
    </a>

    <nav aria-label="Navigasi utama" class="motorrent-header__nav">
      <a href="{{ route('home') }}" @class(['motorrent-header__nav-link', 'is-active' => request()->routeIs('home')])>Beranda</a>
      <a href="{{ route('motors.index') }}" @class(['motorrent-header__nav-link', 'is-active' => request()->routeIs('motors.*')])>Cari Motor</a>
      <a href="{{ route('home') }}#cara-sewa" class="motorrent-header__nav-link">Cara Sewa</a>
      <a href="{{ route('home') }}#bantuan" class="motorrent-header__nav-link">Bantuan</a>
    </nav>

    <div class="motorrent-header__actions">
      <a href="{{ route('motors.index', ['sort' => 'popular']) }}" class="motorrent-header__action">
        <svg viewBox="0 0 24 24" class="motorrent-header__icon" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
        Favorit
      </a>
      <a href="{{ auth()->check() ? route('account.show') : route('login') }}" class="motorrent-header__action">
        <svg viewBox="0 0 24 24" class="motorrent-header__icon" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Akun
        <svg viewBox="0 0 24 24" class="motorrent-header__chevron" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
      </a>
      @auth
      <form method="POST" action="{{ route('logout') }}" class="motorrent-header__action" style="border:0; padding:0; background:transparent;">
        @csrf
        <button type="submit" style="display:flex; align-items:center; gap:6px; color:#647084; font:inherit; font-size:13px; font-weight:650; background:transparent; border:0; cursor:pointer;">
          <svg viewBox="0 0 24 24" style="width:20px; height:20px; stroke:currentColor; stroke-width:2; fill:none; stroke-linecap:round; stroke-linejoin:round;"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
          Keluar
        </button>
      </form>
      @endauth
    </div>

    <div id="mobile-navigation" class="motorrent-header__mobile-panel" data-mobile-menu-panel hidden>
      <div class="motorrent-header__mobile-panel-head">
        <span>Menu</span>
        <button type="button" aria-label="Tutup menu navigasi" class="motorrent-header__mobile-close" data-mobile-menu-close>
          <svg viewBox="0 0 24 24" class="motorrent-header__icon" aria-hidden="true">
            <path d="M6 6l12 12"/>
            <path d="M18 6 6 18"/>
          </svg>
        </button>
      </div>
      <nav aria-label="Navigasi mobile" class="motorrent-header__mobile-nav">
        <a href="{{ route('home') }}" @class(['motorrent-header__mobile-link', 'is-active' => request()->routeIs('home')])>Beranda</a>
        <a href="{{ route('motors.index') }}" @class(['motorrent-header__mobile-link', 'is-active' => request()->routeIs('motors.*')])>Cari Motor</a>
        <a href="{{ route('home') }}#cara-sewa" class="motorrent-header__mobile-link">Cara Sewa</a>
        <a href="{{ route('home') }}#bantuan" class="motorrent-header__mobile-link">Bantuan</a>
        <a href="{{ route('motors.index', ['sort' => 'popular']) }}" class="motorrent-header__mobile-link">Favorit</a>
        <a href="{{ auth()->check() ? route('account.show') : route('login') }}" class="motorrent-header__mobile-link">Akun</a>
      </nav>
    </div>
  </div>
</header>

<script>
  (() => {
    const header = document.querySelector('.motorrent-header');
    const toggle = document.querySelector('[data-mobile-menu-toggle]');
    const panel = document.querySelector('[data-mobile-menu-panel]');
    const close = document.querySelector('[data-mobile-menu-close]');

    if (!header || !toggle || !panel) {
      return;
    }

    const setOpen = (isOpen) => {
      header.classList.toggle('is-mobile-menu-open', isOpen);
      toggle.setAttribute('aria-expanded', String(isOpen));
      panel.hidden = !isOpen;
    };

    toggle.addEventListener('click', () => {
      setOpen(toggle.getAttribute('aria-expanded') !== 'true');
    });

    close?.addEventListener('click', () => {
      setOpen(false);
    });

    panel.addEventListener('click', (event) => {
      if (event.target.closest('a')) {
        setOpen(false);
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        setOpen(false);
      }
    });

    window.addEventListener('resize', () => {
      if (window.matchMedia('(min-width: 901px)').matches) {
        setOpen(false);
      }
    });
  })();
</script>
