const serverData = window.MOTO_RENT_DATA || {};

const brands = serverData.brands || [];
const types = [{ name: 'Semua', icon: gridIcon() }, ...(serverData.types || []).map((type) => ({
  ...type,
  icon: iconForType(type.name),
}))];
const motors = serverData.motors || [];

let activeBrand = '';
let activeType = 'Semua';
const favorites = new Set();

const brandStrip = document.querySelector('#brandStrip');
const typeStrip = document.querySelector('#typeStrip');
const motorGrid = document.querySelector('#motorGrid');
const motorType = document.querySelector('#motorType');
const toast = document.querySelector('#toast');

function formatRupiah(value) {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
  }).format(value).replace('IDR', 'Rp');
}

function renderBrands() {
  brandStrip.innerHTML = brands.map((brand) => `
    <button class="group rounded-[28px] border px-5 py-5 text-left shadow-sm transition ${activeBrand === brand.name ? 'border-brand-500 bg-brand-50 ring-2 ring-brand-100' : 'border-slate-200 bg-white hover:border-brand-200 hover:bg-brand-50/60'}" type="button" data-brand="${brand.name}" aria-label="Filter merek ${brand.name}">
      <span class="flex h-14 items-center justify-center rounded-2xl bg-slate-50 p-3">${brand.logo ? `<img src="${brand.logo}" alt="${brand.name}" class="max-h-10 w-auto">` : `<em class="text-sm font-black text-slate-700 not-italic">${brand.label || brand.name}</em>`}</span>
      <strong class="mt-4 block text-base font-black text-ink">${brand.name}</strong>
    </button>
  `).join('');
}

function renderTypes() {
  typeStrip.innerHTML = types.map((type) => `
    <button class="inline-flex items-center gap-3 rounded-full border px-4 py-3 text-sm font-black transition ${activeType === type.name ? 'border-brand-500 bg-brand-600 text-white shadow-brand' : 'border-slate-200 bg-white text-slate-700 hover:border-brand-200 hover:text-brand-600'}" type="button" data-type="${type.name}">
      <span class="h-5 w-5">${type.icon}</span>
      <span>${type.name}</span>
    </button>
  `).join('');
}

function filterMotors() {
  const selectedMotorType = motorType && motorType.value !== 'Semua Jenis' ? motorType.value : 'Semua';

  return motors
    .filter((motor) => !activeBrand || motor.brand === activeBrand)
    .filter((motor) => activeType === 'Semua' || motor.type === activeType)
    .filter((motor) => selectedMotorType === 'Semua' || motor.type === selectedMotorType);
}

function toneClass(tone) {
  const tones = {
    blue: 'from-brand-50 to-slate-50',
    mint: 'from-cyan-50 to-slate-50',
    cream: 'from-amber-50 to-slate-50',
    lavender: 'from-fuchsia-50 to-slate-50',
  };

  return tones[tone] || tones.blue;
}

function renderMotors() {
  const visibleMotors = filterMotors().slice(0, 8);

  motorGrid.innerHTML = visibleMotors.map((motor) => `
    <article class="overflow-hidden rounded-[28px] border border-slate-200 bg-white p-5 shadow-soft transition hover:-translate-y-1 hover:shadow-xl">
      <div class="relative rounded-[24px] bg-gradient-to-br ${toneClass(motor.tone)} p-4">
        <button class="absolute right-3 top-3 inline-flex h-10 w-10 items-center justify-center rounded-full border ${favorites.has(motor.name) ? 'border-red-200 bg-red-50 text-red-500' : 'border-white/80 bg-white/90 text-slate-400'}" type="button" aria-label="Favorit ${motor.name}" data-favorite="${motor.name}">
          <svg viewBox="0 0 24 24" class="h-5 w-5"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </button>
        <img class="mx-auto h-44 w-full object-contain drop-shadow-lg" src="${motor.image}" alt="${motor.name}" loading="lazy">
      </div>
      <h3 class="mt-5 text-xl font-black text-ink">${motor.name}</h3>
      <div class="mt-2 flex items-center gap-2 text-sm font-bold text-amber-500"><span>★</span><b class="text-slate-700">${motor.rating}</b><span class="text-slate-400">(${motor.reviews}+ review)</span></div>
      <div class="mt-4 flex flex-wrap gap-2 text-xs font-bold text-slate-600">
        <span class="rounded-full border border-slate-200 px-3 py-1">${motor.brand}</span>
        <span class="rounded-full border border-slate-200 px-3 py-1">${motor.cc} cc</span>
        <span class="rounded-full border border-slate-200 px-3 py-1">${motor.trans}</span>
      </div>
      <div class="mt-5 flex items-center justify-between gap-3">
        <div><div class="text-2xl font-black text-brand-600">${formatRupiah(motor.price)}</div><small class="text-sm font-semibold text-slate-500">/hari</small></div>
        <button class="inline-flex items-center rounded-full bg-brand-600 px-4 py-2 text-sm font-black text-white shadow-brand hover:bg-brand-700" type="button" data-detail="${motor.name}" data-url="${motor.detailUrl || ''}">Lihat Detail</button>
      </div>
    </article>
  `).join('') || `<p class="col-span-full rounded-[28px] border border-dashed border-slate-300 bg-white px-6 py-16 text-center text-sm font-semibold text-slate-500">Motor tidak ditemukan. Coba ubah filter.</p>`;
}

function bindEvents() {
  brandStrip.addEventListener('click', (event) => {
    const button = event.target.closest('[data-brand]');
    if (!button) return;

    activeBrand = activeBrand === button.dataset.brand ? '' : button.dataset.brand;
    render();
  });

  typeStrip.addEventListener('click', (event) => {
    const button = event.target.closest('[data-type]');
    if (!button) return;

    activeType = button.dataset.type;
    render();
  });

  motorGrid.addEventListener('click', (event) => {
    const favoriteButton = event.target.closest('[data-favorite]');
    const detailButton = event.target.closest('[data-detail]');

    if (favoriteButton) {
      const name = favoriteButton.dataset.favorite;
      favorites.has(name) ? favorites.delete(name) : favorites.add(name);
      renderMotors();
      showToast(favorites.has(name) ? `${name} ditambahkan ke favorit.` : `${name} dihapus dari favorit.`);
    }

    if (detailButton) {
      if (detailButton.dataset.url) {
        window.location.href = detailButton.dataset.url;
        return;
      }

      showToast(`Detail ${detailButton.dataset.detail} siap dibuka.`);
    }
  });

  const searchBtn = document.querySelector('#searchBtn');
  if (searchBtn) {
    searchBtn.addEventListener('click', () => {
      const location = document.querySelector('#location').value || 'lokasi pilihan';
      if (serverData.catalogUrl) {
        const params = new URLSearchParams();
        params.set('location', location.split(',')[0]);
        if (motorType && motorType.value !== 'Semua Jenis') params.set('type', motorType.value.toLowerCase());
        window.location.href = `${serverData.catalogUrl}?${params.toString()}`;
        return;
      }
      showToast(`Mencari motor terbaik untuk ${location}.`);
      renderMotors();
    });
  }

  if (motorType) {
    motorType.addEventListener('change', renderMotors);
  }

  const showAllBtn = document.querySelector('#showAllBtn');
  if (showAllBtn) {
    showAllBtn.addEventListener('click', () => {
      activeBrand = '';
      activeType = 'Semua';
      render();
      showToast('Semua motor rekomendasi sedang ditampilkan.');
    });
  }
}

function showToast(message) {
  toast.textContent = message;
  toast.classList.remove('opacity-0');
  toast.classList.add('opacity-100');
  clearTimeout(showToast.timer);
  showToast.timer = setTimeout(() => {
    toast.classList.remove('opacity-100');
    toast.classList.add('opacity-0');
  }, 2400);
}

function render() {
  renderBrands();
  renderTypes();
  renderMotors();
}

function gridIcon() {
  return '<svg viewBox="0 0 24 24"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>';
}

function scooterIcon() {
  return '<svg viewBox="0 0 24 24"><circle cx="7" cy="17" r="3"/><circle cx="18" cy="17" r="3"/><path d="M7 17h7l3-8h3M9 10h5l-2 7M7 7h5"/></svg>';
}

function sportIcon() {
  return '<svg viewBox="0 0 24 24"><circle cx="6" cy="17" r="3"/><circle cx="18" cy="17" r="3"/><path d="M6 17h5l4-7h4l1 7M9 11h5l-3 6M11 8h4"/></svg>';
}

function trailIcon() {
  return '<svg viewBox="0 0 24 24"><circle cx="6" cy="17" r="3"/><circle cx="19" cy="17" r="3"/><path d="M6 17h6l5-9h3M8 10h6l-2 7M11 6h5"/></svg>';
}

function electricIcon() {
  return '<svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9z"/></svg>';
}

function iconForType(typeName) {
  const normalized = typeName.toLowerCase();
  if (normalized.includes('matic') || normalized.includes('classic')) return scooterIcon();
  if (normalized.includes('trail')) return trailIcon();
  if (normalized.includes('elektrik')) return electricIcon();
  return sportIcon();
}

if (brandStrip && typeStrip && motorGrid && toast) {
  render();
  bindEvents();
}
