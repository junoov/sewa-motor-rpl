# 📋 Product Requirements Document (PRD)
# MotoRent — Platform Sewa Motor Online

---

| Informasi Proyek | Detail |
|---|---|
| **Nama Produk** | MotoRent |
| **Versi Dokumen** | 1.0 |
| **Tanggal** | 28 April 2026 |
| **Jenis Aplikasi** | Website Responsif |
| **Target Rilis** | - |

---

## 1. Ringkasan Eksekutif

MotoRent adalah platform web sewa motor online yang memudahkan pengguna untuk mencari, memesan, dan membayar sewa motor secara digital. Platform ini menghubungkan penyedia layanan rental motor dengan pelanggan melalui antarmuka yang intuitif dan modern.

### 1.1 Masalah yang Diselesaikan
- Proses penyewaan motor yang masih manual (telepon/WhatsApp) dan tidak efisien
- Tidak ada transparansi harga dan ketersediaan motor secara real-time
- Kesulitan pelanggan membandingkan pilihan motor dari berbagai penyedia
- Proses verifikasi identitas dan pembayaran yang rumit

### 1.2 Tujuan Produk
- Menyediakan platform digital yang memudahkan proses sewa motor dari awal hingga akhir
- Meningkatkan kepercayaan pelanggan melalui transparansi harga dan review
- Membantu pemilik rental mengelola armada dan pesanan secara efisien
- Menyediakan pengalaman pemesanan yang cepat (< 5 menit)

---

## 2. User Personas

### 2.1 Pelanggan (Penyewa Motor)
| Atribut | Detail |
|---|---|
| **Usia** | 18–45 tahun |
| **Profil** | Wisatawan domestik/internasional, pekerja, mahasiswa |
| **Kebutuhan** | Sewa motor jangka pendek/panjang dengan proses mudah |
| **Pain Point** | Proses manual lambat, harga tidak transparan, takut penipuan |

### 2.2 Admin / Pemilik Rental
| Atribut | Detail |
|---|---|
| **Usia** | 25–55 tahun |
| **Profil** | Pemilik usaha rental motor |
| **Kebutuhan** | Mengelola inventaris, pesanan, dan pendapatan secara digital |
| **Pain Point** | Pencatatan manual, kesulitan tracking motor, komunikasi pelanggan yang tidak efisien |

---

## 3. Fitur Utama (Core Features)

### 3.1 🏠 Landing Page & Navigasi
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-01 | Hero Section | 🔴 High | Tampilan utama dengan tagline, gambar motor, dan CTA |
| F-02 | Navigasi Header | 🔴 High | Logo, menu navigasi, tombol login/daftar |
| F-03 | Search Panel | 🔴 High | Form pencarian dengan filter lokasi, tanggal mulai & selesai |
| F-04 | Keunggulan (Feature Strip) | 🟡 Medium | Highlight value proposition (proses cepat, motor terawat, harga transparan, bantuan 24/7) |
| F-05 | Footer | 🟡 Medium | Informasi kontak, link penting, sosial media |

---

### 3.2 🔐 Autentikasi & Manajemen Akun
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-06 | Registrasi | 🔴 High | Pendaftaran akun baru dengan email, nama, no. HP, password |
| F-07 | Login | 🔴 High | Login dengan email & password |
| F-08 | Lupa Password | 🟡 Medium | Reset password via email |
| F-09 | Profil Pengguna | 🔴 High | Edit data diri, foto profil, alamat |
| F-10 | Upload KTP/SIM | 🔴 High | Verifikasi identitas untuk keamanan sewa |
| F-11 | Login Sosial Media | 🟢 Low | Login via Google / Facebook (opsional) |

---

### 3.3 🏍️ Katalog & Pencarian Motor
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-12 | Daftar Motor | 🔴 High | Grid/list motor yang tersedia dengan gambar, nama, harga/hari |
| F-13 | Filter & Sorting | 🔴 High | Filter berdasarkan: merek, tipe (matic/manual/sport), harga, lokasi |
| F-14 | Detail Motor | 🔴 High | Halaman detail: spesifikasi, galeri foto, harga, ketersediaan, syarat & ketentuan |
| F-15 | Pencarian Motor | 🔴 High | Search bar dengan autocomplete untuk nama/merek motor |
| F-16 | Status Ketersediaan | 🔴 High | Tampilkan status real-time: tersedia / sedang disewa |
| F-17 | Filter Merek | 🟡 Medium | Shortcut filter berdasarkan merek (Honda, Yamaha, Kawasaki, dll) |
| F-18 | Perbandingan Motor | 🟢 Low | Bandingkan 2–3 motor side-by-side |

---

### 3.4 📅 Pemesanan (Booking)
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-19 | Form Pemesanan | 🔴 High | Input tanggal sewa, durasi, lokasi pengambilan, data penyewa |
| F-20 | Kalkulasi Harga Otomatis | 🔴 High | Hitung total biaya berdasarkan durasi × harga per hari |
| F-21 | Pilihan Add-on | 🟡 Medium | Tambahan: asuransi, helm ekstra, antar jemput, jas hujan |
| F-22 | Ringkasan Pesanan | 🔴 High | Review detail sebelum bayar: motor, durasi, total harga, add-on |
| F-23 | Syarat & Ketentuan | 🔴 High | Checkbox persetujuan S&K sewa sebelum konfirmasi |
| F-24 | Kode Promo / Voucher | 🟢 Low | Input kode diskon untuk potongan harga |

---

### 3.5 💳 Pembayaran
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-25 | Metode Pembayaran | 🔴 High | Transfer bank, e-wallet (GoPay, OVO, Dana), QRIS |
| F-26 | Konfirmasi Pembayaran | 🔴 High | Upload bukti transfer / konfirmasi otomatis dari payment gateway |
| F-27 | Invoice Digital | 🟡 Medium | Generate invoice/PDF otomatis setelah pembayaran berhasil |
| F-28 | Sistem Deposit | 🟡 Medium | Deposit jaminan yang dikembalikan setelah motor dikembalikan |

---

### 3.6 📊 Dashboard Pelanggan
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-29 | Riwayat Pesanan | 🔴 High | Daftar semua pesanan aktif, selesai, dan dibatalkan |
| F-30 | Status Pesanan | 🔴 High | Tracking status: menunggu pembayaran → dikonfirmasi → sedang disewa → selesai |
| F-31 | Detail Pesanan | 🔴 High | Lihat detail lengkap setiap pesanan |
| F-32 | Batalkan Pesanan | 🟡 Medium | Pembatalan pesanan dengan kebijakan refund |
| F-33 | Perpanjangan Sewa | 🟡 Medium | Perpanjang durasi sewa langsung dari dashboard |

---

### 3.7 ⭐ Review & Rating
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-34 | Beri Rating | 🟡 Medium | Rating 1–5 bintang setelah sewa selesai |
| F-35 | Tulis Ulasan | 🟡 Medium | Ulasan teks tentang pengalaman sewa |
| F-36 | Lihat Ulasan | 🟡 Medium | Tampilkan rating & ulasan di halaman detail motor |

---

### 3.8 🔧 Panel Admin (Back Office)
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-37 | Dashboard Admin | 🔴 High | Overview: total pesanan, pendapatan, motor tersedia, pelanggan baru |
| F-38 | Manajemen Motor | 🔴 High | CRUD motor: tambah, edit, hapus, upload foto, set harga |
| F-39 | Manajemen Pesanan | 🔴 High | Lihat, konfirmasi, tolak, dan kelola semua pesanan |
| F-40 | Manajemen Pelanggan | 🔴 High | Lihat daftar pelanggan, verifikasi KTP/SIM |
| F-41 | Laporan Keuangan | 🟡 Medium | Laporan pendapatan harian/mingguan/bulanan dengan grafik |
| F-42 | Manajemen Lokasi | 🟡 Medium | Kelola titik pengambilan/pengembalian motor |
| F-43 | Manajemen Promo | 🟢 Low | Buat dan kelola kode promo / voucher |
| F-44 | Manajemen Konten | 🟢 Low | Edit konten landing page, FAQ, syarat & ketentuan |

---

### 3.9 🔔 Notifikasi
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-45 | Email Notifikasi | 🔴 High | Konfirmasi booking, reminder pengembalian, invoice |
| F-46 | WhatsApp Notifikasi | 🟡 Medium | Notifikasi status pesanan via WhatsApp |
| F-47 | Push Notification | 🟢 Low | Notifikasi browser untuk update status pesanan |

---

### 3.10 📱 Responsivitas & UX
| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-48 | Responsive Design | 🔴 High | Tampilan optimal di desktop, tablet, dan mobile |
| F-49 | Loading State | 🟡 Medium | Skeleton loading, spinner, dan feedback visual |
| F-50 | Toast Notification | 🟡 Medium | Pesan feedback aksi pengguna (sukses, error, warning) |
| F-51 | Accessibility | 🟡 Medium | Keyboard navigable, screen reader friendly, ARIA labels |

---

## 4. Fitur Tambahan (Nice-to-Have)

| ID | Fitur | Prioritas | Deskripsi |
|---|---|---|---|
| F-52 | Live Chat | 🟢 Low | Chat real-time dengan customer service |
| F-53 | Multi-bahasa | 🟢 Low | Support Bahasa Indonesia & English |
| F-54 | Wishlist | 🟢 Low | Tandai motor favorit untuk nanti |
| F-55 | Rekomendasi Motor | 🟢 Low | Rekomendasi berdasarkan riwayat atau popularitas |
| F-56 | Referral Program | 🟢 Low | Undang teman untuk mendapat diskon |
| F-57 | GPS Tracking | 🟢 Low | Tracking lokasi motor (fitur lanjutan) |

---

## 5. Alur Pengguna (User Flow)

### 5.1 Alur Penyewa Motor

```
Buka Website
    ↓
Landing Page (Hero + Search)
    ↓
Pilih Lokasi & Tanggal → Cari Motor
    ↓
Lihat Katalog Motor → Filter/Sorting
    ↓
Pilih Motor → Lihat Detail & Harga
    ↓
Login / Daftar (jika belum login)
    ↓
Isi Form Pemesanan + Upload KTP/SIM
    ↓
Review Pesanan + Pilih Add-on
    ↓
Lakukan Pembayaran
    ↓
Konfirmasi → Terima Invoice via Email
    ↓
Ambil Motor di Lokasi
    ↓
Gunakan Motor Selama Durasi Sewa
    ↓
Kembalikan Motor → Beri Rating & Review
```

### 5.2 Alur Admin

```
Login Admin
    ↓
Dashboard Overview
    ↓
Kelola Motor (CRUD) / Kelola Pesanan / Kelola Pelanggan
    ↓
Konfirmasi/Tolak Pesanan Masuk
    ↓
Monitoring Sewa Aktif
    ↓
Catat Pengembalian Motor
    ↓
Lihat Laporan Keuangan
```

---

## 6. Arsitektur Halaman (Sitemap)

```
MotoRent/
├── 🏠 Home (Landing Page)
├── 🔍 Katalog Motor
│   ├── Filter & Sorting
│   └── Detail Motor
├── 📅 Pemesanan
│   ├── Form Booking
│   ├── Ringkasan & Pembayaran
│   └── Konfirmasi
├── 🔐 Autentikasi
│   ├── Login
│   ├── Daftar
│   └── Lupa Password
├── 👤 Dashboard Pelanggan
│   ├── Profil & Verifikasi
│   ├── Riwayat Pesanan
│   └── Detail Pesanan
├── 🔧 Panel Admin
│   ├── Dashboard
│   ├── Manajemen Motor
│   ├── Manajemen Pesanan
│   ├── Manajemen Pelanggan
│   ├── Laporan Keuangan
│   └── Pengaturan
├── ℹ️ Bantuan / FAQ
├── 📄 Syarat & Ketentuan
└── 📄 Kebijakan Privasi
```

---

## 7. Non-Functional Requirements

### 7.1 Performa
| Metrik | Target |
|---|---|
| Waktu muat halaman (FCP) | < 2 detik |
| Waktu respons API | < 500 ms |
| Uptime | 99.5% |

### 7.2 Keamanan
- Enkripsi password dengan bcrypt/argon2
- HTTPS wajib di seluruh halaman
- Validasi input di sisi klien dan server
- Proteksi CSRF dan XSS
- Penyimpanan data sensitif (KTP/SIM) terenkripsi
- Rate limiting untuk mencegah brute-force

### 7.3 Skalabilitas
- Arsitektur yang mendukung penambahan lokasi baru
- Database yang dapat menangani 10.000+ data motor
- CDN untuk aset statis (gambar motor)

---

## 8. Tech Stack (Rekomendasi)

| Layer | Teknologi |
|---|---|
| **Frontend** | HTML, CSS, JavaScript (saat ini) / dapat di-upgrade ke React/Next.js |
| **Backend** | Node.js (Express) / Laravel / Django |
| **Database** | PostgreSQL / MySQL |
| **Storage** | Cloudinary / AWS S3 (gambar motor, KTP) |
| **Payment Gateway** | Midtrans / Xendit |
| **Hosting** | Vercel / Railway / VPS |
| **Notifikasi** | Nodemailer (email), Fonnte/Twilio (WhatsApp) |

---

## 9. Prioritas Pengembangan (Roadmap)

### Fase 1 — MVP (4–6 minggu)
- [x] Landing page dengan hero & search panel
- [x] Katalog motor dengan filter merek & tipe
- [ ] Autentikasi (login, daftar, profil)
- [ ] Detail motor & form pemesanan
- [ ] Pembayaran manual (transfer bank)
- [ ] Dashboard pesanan pelanggan
- [ ] Panel admin dasar (CRUD motor & pesanan)

### Fase 2 — Enhancement (4 minggu)
- [ ] Payment gateway integration (Midtrans/Xendit)
- [ ] Notifikasi email & WhatsApp
- [ ] Review & rating
- [ ] Laporan keuangan admin
- [ ] Perpanjangan sewa
- [ ] Invoice digital

### Fase 3 — Advanced (4 minggu)
- [ ] Kode promo & voucher
- [ ] Live chat
- [ ] Multi-bahasa
- [ ] Rekomendasi motor
- [ ] GPS tracking
- [ ] PWA (Progressive Web App)

---

## 10. Kriteria Keberhasilan (Success Metrics)

| Metrik | Target |
|---|---|
| Waktu booking rata-rata | < 5 menit |
| Conversion rate (visit → booking) | > 3% |
| Customer satisfaction (rating) | > 4.0 / 5.0 |
| Tingkat pembatalan | < 15% |
| Repeat customer rate | > 30% |

---

## 11. Risiko & Mitigasi

| Risiko | Dampak | Mitigasi |
|---|---|---|
| Penyewa tidak mengembalikan motor | 🔴 Tinggi | Deposit wajib, verifikasi KTP/SIM, batas sewa |
| Kerusakan motor saat disewa | 🔴 Tinggi | Dokumentasi foto sebelum & sesudah, asuransi |
| Pembayaran gagal / fraud | 🟡 Sedang | Integrasi payment gateway resmi |
| Data KTP/SIM bocor | 🔴 Tinggi | Enkripsi data, akses terbatas, compliance |
| Server down | 🟡 Sedang | Monitoring, auto-scaling, backup |

---

> **Catatan:** Dokumen ini merupakan panduan pengembangan awal dan dapat diperbarui sesuai kebutuhan. Fitur yang ditandai ✅ sudah diimplementasikan pada versi saat ini.
