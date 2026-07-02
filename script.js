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

const motors = [
  { name: "Honda Beat", brand: "Honda", type: "Matic", image: "assets/motors/honda-beat-cutout.png", cc: 110, seats: 2, trans: "Matic", rating: 4.7, reviews: 80, price: 55000, tone: "blue" },
  { name: "Yamaha Aerox 155", brand: "Yamaha", type: "Matic", image: "assets/motors/yamaha-aerox-155-cutout.png", cc: 155, seats: 2, trans: "Matic", rating: 4.8, reviews: 70, price: 85000, tone: "mint" },
  { name: "Kawasaki Z250", brand: "Kawasaki", type: "Naked", image: "assets/motors/kawasaki-z250-cutout.png", cc: 250, seats: 2, trans: "Manual", rating: 4.9, reviews: 65, price: 150000, tone: "cream" },
  { name: "BMW G 310 GS", brand: "BMW", type: "Sport", image: "assets/motors/kawasaki-klx-cutout.png", cc: 313, seats: 2, trans: "Manual", rating: 4.8, reviews: 45, price: 180000, tone: "lavender" },
  { name: "Honda Vario 125", brand: "Honda", type: "Matic", image: "assets/motors/honda-vario-125-cutout.png", cc: 125, seats: 2, trans: "Matic", rating: 4.9, reviews: 120, price: 70000, tone: "blue" },
  { name: "Yamaha NMAX 155", brand: "Yamaha", type: "Matic", image: "assets/motors/yamaha-nmax-155-cutout.png", cc: 155, seats: 2, trans: "Matic", rating: 4.8, reviews: 95, price: 90000, tone: "mint" },
  { name: "Honda Scoopy", brand: "Honda", type: "Matic", image: "assets/motors/honda-vario-125-cutout.png", cc: 110, seats: 2, trans: "Matic", rating: 4.6, reviews: 60, price: 65000, tone: "cream" },
  { name: "Vespa Sprint", brand: "Vespa", type: "Matic", image: "assets/motors/vespa-sprint-cutout.png", cc: 150, seats: 2, trans: "Matic", rating: 4.9, reviews: 45, price: 120000, tone: "lavender" }
];

let activeBrand = "";
let activeType = "Semua";
const favorites = new Set();

const brandStrip = document.querySelector("#brandStrip");
const typeStrip = document.querySelector("#typeStrip");
const motorGrid = document.querySelector("#motorGrid");
const motorType = document.querySelector("#motorType");
const toast = document.querySelector("#toast");
const detailMainImage = document.querySelector("#detailMainImage");
const detailImageCount = document.querySelector("#detailImageCount");
const detailThumbs = Array.from(document.querySelectorAll("[data-gallery-image]"));

function formatRupiah(value) {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    maximumFractionDigits: 0
  }).format(value).replace("IDR", "Rp");
}

function renderBrands() {
  brandStrip.innerHTML = brands.map((brand) => `
    <button class="brand-card ${activeBrand === brand.name ? "active" : ""}" type="button" data-brand="${brand.name}" aria-label="Filter merek ${brand.name}">
      <span class="brand-logo">${brand.logo ? `<img src="${brand.logo}" alt="${brand.name}">` : `<em>${brand.label}</em>`}</span>
      <strong>${brand.name}</strong>
    </button>
  `).join("");
}

function renderTypes() {
  typeStrip.innerHTML = types.map((type) => `
    <button class="type-btn ${activeType === type.name ? "active" : ""}" type="button" data-type="${type.name}">
      ${type.icon}
      <span>${type.name}</span>
    </button>
  `).join("");
}

function filterMotors() {
  const selectedMotorType = motorType && motorType.value !== "Semua Jenis" ? motorType.value : "Semua";

  return motors
    .filter((motor) => !activeBrand || motor.brand === activeBrand)
    .filter((motor) => activeType === "Semua" || motor.type === activeType)
    .filter((motor) => selectedMotorType === "Semua" || motor.type === selectedMotorType);
}

function renderMotors() {
  const visibleMotors = filterMotors().slice(0, 8);

  motorGrid.innerHTML = visibleMotors.map((motor) => `
    <article class="motor-card tone-${motor.tone}">
      <button class="favorite-btn ${favorites.has(motor.name) ? "active" : ""}" type="button" aria-label="Favorit ${motor.name}" data-favorite="${motor.name}">
        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
      </button>
      <img class="bike-photo" src="${motor.image}" alt="${motor.name}" loading="lazy">
      <h3>${motor.name}</h3>
      <div class="rating">
        <svg viewBox="0 0 24 24"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        <b>${motor.rating}</b> (${motor.reviews}+ review)
      </div>
      <div class="specs">
        <span><svg viewBox="0 0 24 24"><path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M19 12a7 7 0 0 0-.1-1l2-1.5-2-3.5-2.4 1a7.4 7.4 0 0 0-1.7-1L14.5 3h-5l-.3 3a7.4 7.4 0 0 0-1.7 1L5.1 6 3 9.5 5.1 11a7 7 0 0 0 0 2L3 14.5 5.1 18l2.4-1a7.4 7.4 0 0 0 1.7 1l.3 3h5l.3-3a7.4 7.4 0 0 0 1.7-1l2.4 1 2.1-3.5-2.1-1.5c.1-.3.1-.7.1-1Z"/></svg> ${motor.seats} Helm</span>
        <span><svg viewBox="0 0 24 24"><path d="M8 8h8v8H8zM4 12h4M16 12h4M10 4v4M14 4v4M10 16v4M14 16v4"/></svg> ${motor.cc} cc</span>
        <span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="21.17" x2="12" y1="8" y2="8"/><line x1="3.95" x2="8.54" y1="6.06" y2="14"/><line x1="10.88" x2="15.46" y1="21.94" y2="14"/></svg> ${motor.trans}</span>
      </div>
      <div class="price">${formatRupiah(motor.price)} <small>/hari</small></div>
      <button class="detail-btn" type="button" data-detail="${motor.name}">Lihat Detail</button>
    </article>
  `).join("") || `<p class="empty-state">Motor tidak ditemukan. Coba ubah filter.</p>`;
}

function bindEvents() {
  bindDetailGallery();

  brandStrip.addEventListener("click", (event) => {
    const button = event.target.closest("[data-brand]");
    if (!button) return;

    activeBrand = activeBrand === button.dataset.brand ? "" : button.dataset.brand;
    render();
  });

  typeStrip.addEventListener("click", (event) => {
    const button = event.target.closest("[data-type]");
    if (!button) return;

    activeType = button.dataset.type;
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
      document.querySelector(".desktop-detail-section")?.scrollIntoView({ behavior: "smooth", block: "start" });
      showToast(`Detail ${detailButton.dataset.detail} dibuka.`);
    }
  });

  const searchBtn = document.querySelector("#searchBtn");
  if(searchBtn) {
    searchBtn.addEventListener("click", () => {
      const location = document.querySelector("#location").value || "lokasi pilihan";
      showToast(`Mencari motor terbaik untuk ${location}.`);
      renderMotors();
    });
  }

  if (motorType) {
    motorType.addEventListener("change", renderMotors);
  }

  const showAllBtn = document.querySelector("#showAllBtn");
  if (showAllBtn) {
    showAllBtn.addEventListener("click", () => {
      activeBrand = "";
      activeType = "Semua";
      render();
      showToast("Semua motor rekomendasi sedang ditampilkan.");
    });
  }
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
  toast.classList.add("show");
  clearTimeout(showToast.timer);
  showToast.timer = setTimeout(() => toast.classList.remove("show"), 2400);
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

render();
bindEvents();
