const serverData = window.MOTO_RENT_DATA || {};
const detailUrls = new Map((serverData.motors || []).map((motor) => [motor.name, motor.detailUrl]));

const brands = [
  { name: "Honda", logo: "assets/logos/honda.svg" },
  { name: "Yamaha", logo: "assets/logos/yamaha.svg" },
  { name: "Suzuki", logo: "assets/logos/suzuki.svg" },
  { name: "Kawasaki", logo: "assets/logos/kawasaki.svg" },
  { name: "Vespa", logo: "assets/logos/vespa.svg" },
  { name: "KTM", logo: "assets/logos/ktm.svg" },
  { name: "BMW", label: "BMW" },
  { name: "Aprilia", label: "aprilia" },
  { name: "Benelli", logo: "assets/logos/benelli.svg" },
  { name: "TVS", logo: "assets/logos/tvs.png" }
];

const types = [
  { name: "Semua", icon: gridIcon() },
  { name: "Matic", icon: scooterIcon() },
  { name: "Sport", icon: sportIcon() },
  { name: "Naked", icon: sportIcon() },
  { name: "Trail", icon: trailIcon() },
  { name: "Elektrik", icon: electricIcon() }
];

const fallbackMotors = [
  { name: "Honda Beat", slug: "honda-beat", brand: "Honda", type: "Matic", image: "assets/motors/honda-beat-cutout.png", cc: 110, seats: 2, trans: "Matic", rating: 4.7, reviews: 80, price: 55000, tone: "blue" },
  { name: "Yamaha Aerox 155", slug: "yamaha-aerox-155", brand: "Yamaha", type: "Matic", image: "assets/motors/yamaha-aerox-155-cutout.png", cc: 155, seats: 2, trans: "Matic", rating: 4.8, reviews: 70, price: 85000, tone: "mint" },
  { name: "Kawasaki Z250", slug: "kawasaki-z250", brand: "Kawasaki", type: "Naked", image: "assets/motors/kawasaki-z250-cutout.png", cc: 250, seats: 2, trans: "Manual", rating: 4.9, reviews: 65, price: 150000, tone: "cream" },
  { name: "Kawasaki KLX", slug: "kawasaki-klx", brand: "Kawasaki", type: "Trail", image: "assets/motors/kawasaki-klx-cutout.png", cc: 150, seats: 2, trans: "Manual", rating: 4.7, reviews: 44, price: 130000, tone: "cream" },
  { name: "Honda Vario 125", slug: "honda-vario-125", brand: "Honda", type: "Matic", image: "assets/motors/honda-vario-125-cutout.png", cc: 125, seats: 2, trans: "Matic", rating: 4.9, reviews: 120, price: 70000, tone: "blue" },
  { name: "Yamaha NMAX 155", slug: "yamaha-nmax-155", brand: "Yamaha", type: "Matic", image: "assets/motors/yamaha-nmax-155-cutout.png", cc: 155, seats: 2, trans: "Matic", rating: 4.8, reviews: 95, price: 90000, tone: "mint" },
  { name: "Vespa Sprint", slug: "vespa-sprint", brand: "Vespa", type: "Classic", image: "assets/motors/vespa-sprint-cutout.png", cc: 150, seats: 2, trans: "Matic", rating: 4.9, reviews: 45, price: 120000, tone: "lavender" },
  { name: "Benelli Imperiale", slug: "benelli-imperiale", brand: "Benelli", type: "Classic", image: "assets/motors/benelli-imperiale-cutout.png", cc: 374, seats: 2, trans: "Manual", rating: 4.8, reviews: 38, price: 180000, tone: "lavender" }
];

const motors = (serverData.motors && serverData.motors.length ? serverData.motors : fallbackMotors).map((motor) => ({
  ...motor,
  detailUrl: motor.detailUrl || detailUrls.get(motor.name) || (motor.slug ? `/cari-motor/${motor.slug}` : "")
}));

const toneClasses = {
  blue: "bg-[linear-gradient(180deg,#f7fbff_0%,#eef5ff_100%)]",
  mint: "bg-[linear-gradient(180deg,#f4fffd_0%,#ecfbf6_100%)]",
  cream: "bg-[linear-gradient(180deg,#fffdf5_0%,#fff5df_100%)]",
  lavender: "bg-[linear-gradient(180deg,#fbf8ff_0%,#f1ebff_100%)]"
};

let activeBrand = "";
let activeType = "Semua";
const favorites = new Set();
let currentMotorPage = 1;

const brandStrip = document.querySelector("#brandStrip");
const typeStrip = document.querySelector("#typeStrip");
const motorGrid = document.querySelector("#motorGrid");
const motorPagination = document.querySelector("#motorPagination");
const motorType = document.querySelector("#motorType");
const toast = document.querySelector("#toast");
const detailMainImage = document.querySelector("#detailMainImage");
const detailImageCount = document.querySelector("#detailImageCount");
const detailThumbs = Array.from(document.querySelectorAll("[data-gallery-image]"));

const toastVisibleClasses = ["translate-y-0", "opacity-100"];
const toastHiddenClasses = ["pointer-events-none", "translate-y-4", "opacity-0"];

function formatRupiah(value) {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    maximumFractionDigits: 0
  }).format(value).replace("IDR", "Rp");
}

function brandCardClasses(isActive) {
  return [
    "group grid min-h-[86px] place-items-center gap-2 rounded-xl border px-3 py-[15px] text-center text-[13px] font-[750] transition duration-200",
    isActive
      ? "border-[#111] bg-[#111] text-white shadow-[0_13px_26px_rgba(7,92,255,0.13)]"
      : "border-[rgba(210,220,235,0.95)] bg-[#f7f7f8] text-[#202938] hover:-translate-y-0.5 hover:border-[#075cff] hover:shadow-[0_13px_26px_rgba(7,92,255,0.13)]"
  ].join(" ");
}

function typeButtonClasses(isActive) {
  return [
    "group grid min-h-[86px] place-items-center gap-2 rounded-xl border px-3 py-[15px] text-center text-[13px] font-[750] transition duration-200",
    isActive
      ? "border-[#111] bg-[#111] text-white shadow-[0_13px_26px_rgba(7,92,255,0.13)]"
      : "border-[rgba(210,220,235,0.95)] bg-[#f7f7f8] text-[#202938] hover:-translate-y-0.5 hover:border-[#075cff] hover:shadow-[0_13px_26px_rgba(7,92,255,0.13)]"
  ].join(" ");
}

function favoriteButtonClasses(isActive) {
  return [
    "absolute right-[14px] top-[14px] z-[2] grid h-9 w-9 place-items-center rounded-full border border-white/70 bg-white/85 shadow-[0_10px_18px_rgba(20,43,76,0.08)] transition",
    isActive ? "text-[#ef2e55]" : "text-[#667187] hover:text-[#ef2e55]"
  ].join(" ");
}

function renderBrands() {
  brandStrip.innerHTML = brands.map((brand) => {
    const isActive = activeBrand === brand.name;

    return `
      <button class="${brandCardClasses(isActive)}" type="button" data-brand="${brand.name}" aria-label="Filter merek ${brand.name}">
        <span class="grid min-h-[30px] place-items-center">
          ${brand.logo
            ? `<img src="${brand.logo}" alt="${brand.name}" class="block h-auto max-h-[30px] w-[96px] max-w-[96px] object-contain ${isActive ? "brightness-0 invert" : "grayscale contrast-[1.12]"}">`
            : `<em class="text-[21px] font-black not-italic tracking-[-1px] ${brand.name === "Aprilia" ? "lowercase text-[#111]" : "text-[#111]"} ${isActive ? "text-white" : ""}">${brand.label}</em>`}
        </span>
        <strong class="block text-[13px] font-[750]">${brand.name}</strong>
      </button>
    `;
  }).join("");
}

function renderTypes() {
  typeStrip.innerHTML = types.map((type) => {
    const isActive = activeType === type.name;

    return `
      <button class="${typeButtonClasses(isActive)}" type="button" data-type="${type.name}">
        <span class="${isActive ? "text-white" : "text-[#202938] group-hover:text-[#075cff]"}">
          ${type.icon}
        </span>
        <span>${type.name}</span>
      </button>
    `;
  }).join("");
}

function filterMotors() {
  const selectedMotorType = motorType && motorType.value !== "Semua Jenis" ? motorType.value : "Semua";

  return motors
    .filter((motor) => !activeBrand || motor.brand === activeBrand)
    .filter((motor) => activeType === "Semua" || motor.type === activeType)
    .filter((motor) => selectedMotorType === "Semua" || motor.type === selectedMotorType);
}

function getMotorPageSize() {
  return 8;
}

function totalMotorPages(totalItems) {
  return Math.max(1, Math.ceil(totalItems / getMotorPageSize()));
}

function renderMotorPagination(totalPages) {
  if (!motorPagination) return;

  motorPagination.classList.add("hidden");
  motorPagination.classList.remove("flex");
  motorPagination.innerHTML = "";
}

function renderMotors() {
  const filteredMotors = filterMotors();
  const pages = totalMotorPages(filteredMotors.length);
  currentMotorPage = Math.min(currentMotorPage, pages);
  const pageSize = getMotorPageSize();
  const start = (currentMotorPage - 1) * pageSize;
  const visibleMotors = filteredMotors.slice(start, start + pageSize);

  motorGrid.innerHTML = visibleMotors.map((motor) => `
    <article class="group relative overflow-hidden rounded-xl border border-[rgba(219,228,241,0.96)] bg-white p-[18px] shadow-[0_10px_24px_rgba(22,45,80,0.045)] transition duration-200 hover:-translate-y-1 hover:shadow-[0_20px_36px_rgba(22,45,80,0.12)]">
      <button class="${favoriteButtonClasses(favorites.has(motor.name))}" type="button" aria-label="Favorit ${motor.name}" data-favorite="${motor.name}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[18px] w-[18px] ${favorites.has(motor.name) ? "fill-current" : "fill-none"}"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
      </button>
      <div class="mb-4 rounded-[24px] px-3 pb-2 pt-4 ${toneClasses[motor.tone] || toneClasses.blue}">
        <img src="${motor.image}" alt="${motor.name}" loading="lazy" class="mx-auto block h-[152px] w-full object-contain object-bottom drop-shadow-[0_11px_11px_rgba(21,31,50,0.14)]">
      </div>
      <h3 class="mb-[7px] mr-8 overflow-hidden text-ellipsis whitespace-nowrap text-[15px] font-black tracking-[-0.2px] text-[#172036]">${motor.name}</h3>
      <div class="mb-[11px] flex items-center gap-1 text-xs font-bold text-[#687386]">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[13px] w-[13px] fill-[#ffb31a] stroke-[#ffb31a] text-[#ffb31a]"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        <b class="text-[#2c3549]">${motor.rating}</b> (${motor.reviews}+ review)
      </div>
      <div class="mb-[15px] flex flex-wrap items-center gap-3 text-xs font-bold text-[#687386]">
        <span class="inline-flex items-center gap-1 whitespace-nowrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[14px] w-[14px]"><path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M19 12a7 7 0 0 0-.1-1l2-1.5-2-3.5-2.4 1a7.4 7.4 0 0 0-1.7-1L14.5 3h-5l-.3 3a7.4 7.4 0 0 0-1.7 1L5.1 6 3 9.5 5.1 11a7 7 0 0 0 0 2L3 14.5 5.1 18l2.4-1a7.4 7.4 0 0 0 1.7 1l.3 3h5l.3-3a7.4 7.4 0 0 0 1.7-1l2.4 1 2.1-3.5-2.1-1.5c.1-.3.1-.7.1-1Z"/></svg> ${motor.seats} Helm</span>
        <span class="inline-flex items-center gap-1 whitespace-nowrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[14px] w-[14px]"><path d="M8 8h8v8H8zM4 12h4M16 12h4M10 4v4M14 4v4M10 16v4M14 16v4"/></svg> ${motor.cc} cc</span>
        <span class="inline-flex items-center gap-1 whitespace-nowrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[14px] w-[14px]"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="21.17" x2="12" y1="8" y2="8"/><line x1="3.95" x2="8.54" y1="6.06" y2="14"/><line x1="10.88" x2="15.46" y1="21.94" y2="14"/></svg> ${motor.trans}</span>
      </div>
      <div class="mb-[14px] text-[20px] font-black tracking-[-0.4px] text-[#075cff]">${formatRupiah(motor.price)} <small class="text-xs font-bold text-[#697386]">/hari</small></div>
      <button class="w-full rounded-[10px] bg-[linear-gradient(180deg,#1267ff,#0053ed)] px-4 py-2.5 text-xs font-black text-white shadow-[0_16px_30px_rgba(7,92,255,0.22)] transition hover:-translate-y-0.5 hover:shadow-[0_18px_34px_rgba(7,92,255,0.26)]" type="button" data-detail="${motor.name}" data-url="${motor.detailUrl || ""}">Lihat Detail</button>
    </article>
  `).join("") || `<p class="col-span-full rounded-2xl border border-dashed border-[#dfe7f3] bg-white px-6 py-6 text-center text-sm font-semibold text-[#697386]">Motor tidak ditemukan. Coba ubah filter.</p>`;

  renderMotorPagination(pages);
}

function bindEvents() {
  bindDetailGallery();

  brandStrip.addEventListener("click", (event) => {
    const button = event.target.closest("[data-brand]");
    if (!button) return;

    activeBrand = activeBrand === button.dataset.brand ? "" : button.dataset.brand;
    currentMotorPage = 1;
    render();
  });

  typeStrip.addEventListener("click", (event) => {
    const button = event.target.closest("[data-type]");
    if (!button) return;

    activeType = button.dataset.type;
    currentMotorPage = 1;
    render();
  });

  motorGrid.addEventListener("click", (event) => {
    const favoriteButton = event.target.closest("[data-favorite]");
    const detailButton = event.target.closest("[data-detail]");

    if (favoriteButton) {
      const name = favoriteButton.dataset.favorite;
      favorites.has(name) ? favorites.delete(name) : favorites.add(name);
      renderMotors();
      showToast(favorites.has(name) ? `${name} ditambahkan ke favorit.` : `${name} dihapus dari favorit.`);
    }

    if (detailButton) {
      const detailUrl = detailButton.dataset.url;

      if (detailUrl) {
        window.location.href = detailUrl;
        return;
      }

      document.querySelector(".desktop-detail-section")?.scrollIntoView({ behavior: "smooth", block: "start" });
      showToast(`Detail ${detailButton.dataset.detail} dibuka.`);
    }
  });

  const searchBtn = document.querySelector("#searchBtn");
  if (searchBtn) {
    searchBtn.addEventListener("click", () => {
      const location = document.querySelector("#location").value || "lokasi pilihan";
      showToast(`Mencari motor terbaik untuk ${location}.`);
      currentMotorPage = 1;
      renderMotors();
    });
  }

  if (motorType) {
    motorType.addEventListener("change", () => {
      currentMotorPage = 1;
      renderMotors();
    });
  }

  const showAllBtn = document.querySelector("#showAllBtn");
  if (showAllBtn) {
    showAllBtn.addEventListener("click", () => {
      activeBrand = "";
      activeType = "Semua";
      currentMotorPage = 1;
      render();
      showToast("Semua motor rekomendasi sedang ditampilkan.");
    });
  }

  window.addEventListener("resize", () => {
    renderMotors();
  });
}

function bindDetailGallery() {
  if (!detailMainImage || !detailThumbs.length) return;

  let activeIndex = detailThumbs.findIndex((button) => button.classList.contains("active"));
  activeIndex = activeIndex >= 0 ? activeIndex : 0;

  const setActiveImage = (index) => {
    activeIndex = (index + detailThumbs.length) % detailThumbs.length;
    const activeThumb = detailThumbs[activeIndex];
    detailThumbs.forEach((button) => button.classList.toggle("active", button === activeThumb));
    detailMainImage.src = activeThumb.dataset.galleryImage;
    detailMainImage.alt = activeThumb.dataset.galleryAlt || "Honda Vario 125";
    if (detailImageCount) {
      detailImageCount.textContent = `${activeIndex + 1} / ${detailThumbs.length}`;
    }
  };

  detailThumbs.forEach((button, index) => {
    button.addEventListener("click", () => setActiveImage(index));
  });

  document.querySelector(".gallery-nav.prev")?.addEventListener("click", () => setActiveImage(activeIndex - 1));
  document.querySelector(".gallery-nav.next")?.addEventListener("click", () => setActiveImage(activeIndex + 1));
  setActiveImage(activeIndex);
}

function showToast(message) {
  toast.textContent = message;
  toast.classList.remove(...toastHiddenClasses);
  toast.classList.add(...toastVisibleClasses);
  clearTimeout(showToast.timer);
  showToast.timer = setTimeout(() => {
    toast.classList.remove(...toastVisibleClasses);
    toast.classList.add(...toastHiddenClasses);
  }, 2400);
}

function render() {
  renderBrands();
  renderTypes();
  renderMotors();
}

function gridIcon() {
  return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-9 w-9 stroke-[1.55]"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>';
}

function scooterIcon() {
  return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-9 w-9 stroke-[1.55]"><circle cx="7" cy="17" r="3"/><circle cx="18" cy="17" r="3"/><path d="M7 17h7l3-8h3M9 10h5l-2 7M7 7h5"/></svg>';
}

function sportIcon() {
  return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-9 w-9 stroke-[1.55]"><circle cx="6" cy="17" r="3"/><circle cx="18" cy="17" r="3"/><path d="M6 17h5l4-7h4l1 7M9 11h5l-3 6M11 8h4"/></svg>';
}

function trailIcon() {
  return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-9 w-9 stroke-[1.55]"><circle cx="6" cy="17" r="3"/><circle cx="19" cy="17" r="3"/><path d="M6 17h6l5-9h3M8 10h6l-2 7M11 6h5"/></svg>';
}

function electricIcon() {
  return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-9 w-9 stroke-[1.55]"><path d="M13 2L3 14h9l-1 8 10-12h-9z"/></svg>';
}

render();
bindEvents();

