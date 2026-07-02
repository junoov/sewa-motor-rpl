# Functional Requirements (FR) & Non-Functional Requirements (NFR)
# MotoRent — Platform Sewa Motor Online

---

| Informasi Proyek | Detail |
|---|---|
| **Nama Produk** | MotoRent |
| **Versi Dokumen** | 1.0 |
| **Tanggal** | 28 April 2026 |

---

# BAGIAN A — Functional Requirements (FR)

Functional Requirements mendefinisikan **apa yang harus dilakukan** oleh sistem.

---

## FR-01: Autentikasi Pengguna

| Atribut | Detail |
|---|---|
| **ID** | FR-01 |
| **Modul** | Autentikasi |
| **Prioritas** | 🔴 High |
| **Aktor** | Pelanggan, Admin |

### Deskripsi
Sistem harus menyediakan mekanisme autentikasi yang aman untuk pelanggan dan admin.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-01.1 | Sistem harus menyediakan form registrasi dengan field: nama lengkap, email, nomor HP, password, dan konfirmasi password | 🔴 High |
| FR-01.2 | Sistem harus memvalidasi format email dan kekuatan password (minimal 8 karakter, kombinasi huruf & angka) | 🔴 High |
| FR-01.3 | Sistem harus menyediakan form login dengan email dan password | 🔴 High |
| FR-01.4 | Sistem harus menampilkan pesan error yang jelas jika login gagal | 🔴 High |
| FR-01.5 | Sistem harus menyediakan fitur "Lupa Password" yang mengirim link reset ke email terdaftar | 🟡 Medium |
| FR-01.6 | Sistem harus mendukung login melalui akun Google (OAuth) | 🟢 Low |
| FR-01.7 | Sistem harus melakukan logout otomatis setelah sesi tidak aktif selama 30 menit | 🟡 Medium |

### Kriteria Penerimaan
- [x] User dapat registrasi dan data tersimpan di database
- [x] User dapat login dengan kredensial yang valid
- [x] User menerima email reset password dan berhasil mengubah password
- [x] Sesi user berakhir otomatis setelah 30 menit tidak aktif

---

## FR-02: Manajemen Profil Pengguna

| Atribut | Detail |
|---|---|
| **ID** | FR-02 |
| **Modul** | Akun Pengguna |
| **Prioritas** | 🔴 High |
| **Aktor** | Pelanggan |

### Deskripsi
Sistem harus memungkinkan pelanggan mengelola data profil dan melakukan verifikasi identitas.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-02.1 | Sistem harus menyediakan halaman profil untuk melihat dan mengedit data diri (nama, email, no. HP, alamat) | 🔴 High |
| FR-02.2 | Sistem harus memungkinkan pelanggan mengunggah foto profil (format JPG/PNG, max 2MB) | 🟡 Medium |
| FR-02.3 | Sistem harus memungkinkan pelanggan mengunggah foto KTP untuk verifikasi identitas | 🔴 High |
| FR-02.4 | Sistem harus memungkinkan pelanggan mengunggah foto SIM C sebagai syarat sewa | 🔴 High |
| FR-02.5 | Sistem harus menampilkan status verifikasi KTP/SIM (belum diverifikasi / menunggu / terverifikasi / ditolak) | 🔴 High |
| FR-02.6 | Sistem harus memungkinkan pelanggan mengubah password dari halaman profil | 🟡 Medium |

### Kriteria Penerimaan
- [x] User dapat mengubah data profil dan perubahan tersimpan
- [x] User dapat upload KTP/SIM dan status verifikasi tampil dengan benar
- [x] Admin menerima notifikasi ketika ada KTP/SIM baru yang perlu diverifikasi

---

## FR-03: Katalog & Pencarian Motor

| Atribut | Detail |
|---|---|
| **ID** | FR-03 |
| **Modul** | Katalog Motor |
| **Prioritas** | 🔴 High |
| **Aktor** | Pelanggan |

### Deskripsi
Sistem harus menampilkan katalog motor yang tersedia dan menyediakan fitur pencarian serta filter.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-03.1 | Sistem harus menampilkan daftar motor dalam bentuk grid card dengan informasi: foto, nama, merek, tipe, harga per hari | 🔴 High |
| FR-03.2 | Sistem harus menyediakan filter berdasarkan **merek** (Honda, Yamaha, Kawasaki, Suzuki, dll) | 🔴 High |
| FR-03.3 | Sistem harus menyediakan filter berdasarkan **tipe** (Matic, Manual/Sport, Bebek) | 🔴 High |
| FR-03.4 | Sistem harus menyediakan filter berdasarkan **rentang harga** (slider atau input min-max) | 🟡 Medium |
| FR-03.5 | Sistem harus menyediakan filter berdasarkan **lokasi pengambilan** | 🔴 High |
| FR-03.6 | Sistem harus menyediakan **sorting**: harga terendah, harga tertinggi, popularitas, rating | 🟡 Medium |
| FR-03.7 | Sistem harus menyediakan **search bar** untuk pencarian berdasarkan nama/merek motor | 🔴 High |
| FR-03.8 | Sistem harus menampilkan **status ketersediaan** motor secara real-time (tersedia/disewa) | 🔴 High |
| FR-03.9 | Sistem harus menampilkan **badge** pada motor yang sedang promo atau paling populer | 🟢 Low |
| FR-03.10 | Sistem harus mendukung **pagination** atau infinite scroll jika motor lebih dari 12 item | 🟡 Medium |

### Kriteria Penerimaan
- [x] Daftar motor tampil dengan informasi lengkap
- [x] Filter dan sorting berfungsi dengan benar dan mengupdate tampilan secara real-time
- [x] Pencarian menampilkan hasil yang relevan
- [x] Status ketersediaan terupdate sesuai data terkini

---

## FR-04: Detail Motor

| Atribut | Detail |
|---|---|
| **ID** | FR-04 |
| **Modul** | Detail Motor |
| **Prioritas** | 🔴 High |
| **Aktor** | Pelanggan |

### Deskripsi
Sistem harus menyediakan halaman detail lengkap untuk setiap motor.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-04.1 | Sistem harus menampilkan **galeri foto motor** (minimal 3 foto dari berbagai sudut) | 🔴 High |
| FR-04.2 | Sistem harus menampilkan **spesifikasi motor**: merek, model, tahun, CC, transmisi, warna, plat nomor (parsial) | 🔴 High |
| FR-04.3 | Sistem harus menampilkan **harga sewa** per hari, per minggu, dan per bulan | 🔴 High |
| FR-04.4 | Sistem harus menampilkan **kalender ketersediaan** untuk melihat tanggal yang tersedia | 🟡 Medium |
| FR-04.5 | Sistem harus menampilkan **syarat & ketentuan sewa** khusus motor tersebut | 🟡 Medium |
| FR-04.6 | Sistem harus menampilkan **review dan rating** dari penyewa sebelumnya | 🟡 Medium |
| FR-04.7 | Sistem harus menyediakan tombol **"Sewa Sekarang"** yang mengarah ke form pemesanan | 🔴 High |
| FR-04.8 | Sistem harus menampilkan **lokasi pengambilan** motor di peta | 🟢 Low |

### Kriteria Penerimaan
- [x] Semua informasi detail motor tampil lengkap
- [x] Galeri foto dapat di-swipe/klik
- [x] Kalender ketersediaan akurat sesuai data pesanan
- [x] Tombol "Sewa Sekarang" mengarahkan ke form pemesanan dengan data motor terisi otomatis

---

## FR-05: Pemesanan (Booking)

| Atribut | Detail |
|---|---|
| **ID** | FR-05 |
| **Modul** | Pemesanan |
| **Prioritas** | 🔴 High |
| **Aktor** | Pelanggan |

### Deskripsi
Sistem harus menyediakan alur pemesanan motor yang lengkap dan mudah.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-05.1 | Sistem harus menampilkan form pemesanan dengan field: tanggal mulai, tanggal selesai, lokasi pengambilan, catatan tambahan | 🔴 High |
| FR-05.2 | Sistem harus **menghitung total biaya otomatis** berdasarkan durasi sewa × harga per hari | 🔴 High |
| FR-05.3 | Sistem harus memvalidasi bahwa tanggal mulai ≥ hari ini dan tanggal selesai > tanggal mulai | 🔴 High |
| FR-05.4 | Sistem harus memvalidasi bahwa motor **tersedia** pada rentang tanggal yang dipilih | 🔴 High |
| FR-05.5 | Sistem harus menyediakan opsi **add-on**: asuransi perjalanan, helm ekstra, jas hujan, antar jemput | 🟡 Medium |
| FR-05.6 | Sistem harus menampilkan **ringkasan pesanan** sebelum user melakukan pembayaran | 🔴 High |
| FR-05.7 | Sistem harus mewajibkan user untuk **menyetujui syarat & ketentuan** sebelum melanjutkan | 🔴 High |
| FR-05.8 | Sistem harus menyediakan input **kode promo/voucher** dengan validasi otomatis | 🟢 Low |
| FR-05.9 | Sistem harus menghasilkan **nomor pesanan unik** untuk setiap pemesanan | 🔴 High |
| FR-05.10 | Sistem harus mewajibkan pelanggan sudah **upload KTP/SIM terverifikasi** sebelum booking | 🔴 High |

### Kriteria Penerimaan
- [x] Form pemesanan berfungsi dan total biaya terhitung otomatis
- [x] Validasi tanggal dan ketersediaan berjalan dengan benar
- [x] Pesanan tersimpan di database dengan nomor unik
- [x] Pelanggan tanpa KTP/SIM terverifikasi tidak bisa melanjutkan booking

---

## FR-06: Pembayaran

| Atribut | Detail |
|---|---|
| **ID** | FR-06 |
| **Modul** | Pembayaran |
| **Prioritas** | 🔴 High |
| **Aktor** | Pelanggan |

### Deskripsi
Sistem harus menyediakan mekanisme pembayaran yang aman dan beragam.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-06.1 | Sistem harus menyediakan metode pembayaran: **transfer bank** (BCA, BRI, Mandiri, BNI) | 🔴 High |
| FR-06.2 | Sistem harus menyediakan metode pembayaran: **e-wallet** (GoPay, OVO, Dana, ShopeePay) | 🟡 Medium |
| FR-06.3 | Sistem harus menyediakan metode pembayaran: **QRIS** | 🟡 Medium |
| FR-06.4 | Sistem harus menampilkan **instruksi pembayaran** yang jelas untuk setiap metode | 🔴 High |
| FR-06.5 | Sistem harus menyediakan **batas waktu pembayaran** (2 jam) sebelum pesanan otomatis dibatalkan | 🔴 High |
| FR-06.6 | Sistem harus menerima **upload bukti pembayaran** (untuk transfer manual) | 🔴 High |
| FR-06.7 | Sistem harus mengkonfirmasi pembayaran secara **otomatis** jika menggunakan payment gateway | 🟡 Medium |
| FR-06.8 | Sistem harus menghasilkan **invoice digital** (PDF) setelah pembayaran berhasil | 🟡 Medium |
| FR-06.9 | Sistem harus menghitung dan menampilkan **deposit jaminan** yang harus dibayar | 🟡 Medium |

### Kriteria Penerimaan
- [x] Semua metode pembayaran tersedia dan berfungsi
- [x] Pembayaran yang melewati batas waktu otomatis dibatalkan
- [x] Invoice PDF ter-generate dan dikirim via email
- [x] Status pembayaran terupdate secara real-time

---

## FR-07: Manajemen Pesanan Pelanggan

| Atribut | Detail |
|---|---|
| **ID** | FR-07 |
| **Modul** | Dashboard Pelanggan |
| **Prioritas** | 🔴 High |
| **Aktor** | Pelanggan |

### Deskripsi
Sistem harus menyediakan dashboard bagi pelanggan untuk mengelola dan memantau pesanan.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-07.1 | Sistem harus menampilkan **daftar semua pesanan** pelanggan dengan filter status | 🔴 High |
| FR-07.2 | Sistem harus menampilkan **status pesanan** secara real-time: Menunggu Pembayaran → Dikonfirmasi → Sedang Disewa → Selesai / Dibatalkan | 🔴 High |
| FR-07.3 | Sistem harus menampilkan **detail pesanan** lengkap: motor, durasi, total biaya, add-on, status | 🔴 High |
| FR-07.4 | Sistem harus memungkinkan pelanggan **membatalkan pesanan** sebelum motor diambil | 🟡 Medium |
| FR-07.5 | Sistem harus menampilkan **kebijakan refund** jika pesanan dibatalkan | 🟡 Medium |
| FR-07.6 | Sistem harus memungkinkan pelanggan **memperpanjang sewa** jika motor masih tersedia | 🟡 Medium |
| FR-07.7 | Sistem harus menampilkan **countdown timer** untuk sisa durasi sewa aktif | 🟢 Low |

### Kriteria Penerimaan
- [x] Daftar pesanan tampil dengan benar dan filter berfungsi
- [x] Status pesanan terupdate secara otomatis
- [x] Pembatalan dan perpanjangan berjalan sesuai kebijakan
- [x] Refund terproses sesuai ketentuan

---

## FR-08: Review & Rating

| Atribut | Detail |
|---|---|
| **ID** | FR-08 |
| **Modul** | Review |
| **Prioritas** | 🟡 Medium |
| **Aktor** | Pelanggan |

### Deskripsi
Sistem harus memungkinkan pelanggan memberikan feedback setelah sewa selesai.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-08.1 | Sistem harus menampilkan prompt review setelah status pesanan berubah menjadi "Selesai" | 🟡 Medium |
| FR-08.2 | Sistem harus menyediakan input **rating 1–5 bintang** | 🟡 Medium |
| FR-08.3 | Sistem harus menyediakan input **ulasan teks** (min 10, max 500 karakter) | 🟡 Medium |
| FR-08.4 | Sistem harus menampilkan **rata-rata rating** dan daftar ulasan di halaman detail motor | 🟡 Medium |
| FR-08.5 | Sistem harus mencegah pelanggan memberikan review ganda untuk pesanan yang sama | 🟡 Medium |

### Kriteria Penerimaan
- [x] Review hanya bisa diberikan setelah pesanan selesai
- [x] Rata-rata rating terhitung dan tampil di detail motor
- [x] Tidak ada duplikasi review

---

## FR-09: Panel Admin

| Atribut | Detail |
|---|---|
| **ID** | FR-09 |
| **Modul** | Admin Panel |
| **Prioritas** | 🔴 High |
| **Aktor** | Admin |

### Deskripsi
Sistem harus menyediakan panel admin untuk mengelola seluruh operasional rental.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-09.1 | Sistem harus menampilkan **dashboard overview**: total pesanan hari ini, pendapatan bulan ini, motor tersedia, pelanggan terdaftar | 🔴 High |
| FR-09.2 | Sistem harus menyediakan **CRUD motor**: tambah motor baru, edit info, upload/ganti foto, hapus motor | 🔴 High |
| FR-09.3 | Sistem harus menyediakan **manajemen pesanan**: lihat semua pesanan, konfirmasi, tolak, tandai selesai | 🔴 High |
| FR-09.4 | Sistem harus menyediakan **verifikasi pelanggan**: lihat KTP/SIM, approve/reject verifikasi | 🔴 High |
| FR-09.5 | Sistem harus menyediakan **laporan keuangan** dengan grafik: pendapatan per hari/minggu/bulan | 🟡 Medium |
| FR-09.6 | Sistem harus memungkinkan admin **mengelola lokasi** pengambilan/pengembalian motor | 🟡 Medium |
| FR-09.7 | Sistem harus memungkinkan admin **membuat dan mengelola kode promo** | 🟢 Low |
| FR-09.8 | Sistem harus memungkinkan admin **mengekspor data** pesanan dan keuangan ke CSV/Excel | 🟡 Medium |
| FR-09.9 | Sistem harus menyediakan **log aktivitas** admin untuk audit trail | 🟢 Low |

### Kriteria Penerimaan
- [x] Dashboard menampilkan statistik akurat secara real-time
- [x] CRUD motor berfungsi lengkap dengan upload gambar
- [x] Admin dapat mengkonfirmasi/menolak pesanan dan verifikasi pelanggan
- [x] Laporan keuangan menampilkan data yang benar

---

## FR-10: Notifikasi

| Atribut | Detail |
|---|---|
| **ID** | FR-10 |
| **Modul** | Notifikasi |
| **Prioritas** | 🔴 High |
| **Aktor** | Pelanggan, Admin |

### Deskripsi
Sistem harus mengirimkan notifikasi otomatis untuk event-event penting.

### Kebutuhan Detail
| No | Kebutuhan | Prioritas |
|---|---|---|
| FR-10.1 | Sistem harus mengirim **email konfirmasi** setelah registrasi berhasil | 🔴 High |
| FR-10.2 | Sistem harus mengirim **email konfirmasi pesanan** setelah pembayaran berhasil | 🔴 High |
| FR-10.3 | Sistem harus mengirim **email reminder** H-1 sebelum tanggal pengambilan motor | 🟡 Medium |
| FR-10.4 | Sistem harus mengirim **email reminder** H-1 sebelum tanggal pengembalian motor | 🟡 Medium |
| FR-10.5 | Sistem harus mengirim **notifikasi WhatsApp** untuk konfirmasi dan reminder (opsional) | 🟡 Medium |
| FR-10.6 | Sistem harus mengirim **notifikasi ke admin** ketika ada pesanan baru masuk | 🔴 High |
| FR-10.7 | Sistem harus mengirim **notifikasi ke admin** ketika ada upload KTP/SIM baru | 🟡 Medium |

### Kriteria Penerimaan
- [x] Email terkirim otomatis pada setiap event yang ditentukan
- [x] Konten email sesuai template yang ditentukan
- [x] Admin menerima notifikasi untuk pesanan dan verifikasi baru

---

# BAGIAN B — Non-Functional Requirements (NFR)

Non-Functional Requirements mendefinisikan **bagaimana sistem harus berperilaku** dari sisi kualitas.

---

## NFR-01: Performa (Performance)

| Atribut | Detail |
|---|---|
| **ID** | NFR-01 |
| **Kategori** | Performance |
| **Prioritas** | 🔴 High |

| No | Kebutuhan | Target | Metrik |
|---|---|---|---|
| NFR-01.1 | **First Contentful Paint (FCP)** halaman landing page | < 1.5 detik | Google Lighthouse |
| NFR-01.2 | **Largest Contentful Paint (LCP)** halaman utama | < 2.5 detik | Google Lighthouse |
| NFR-01.3 | **Time to Interactive (TTI)** | < 3 detik | Google Lighthouse |
| NFR-01.4 | **Response time API** untuk operasi read | < 300 ms | Server monitoring |
| NFR-01.5 | **Response time API** untuk operasi write | < 500 ms | Server monitoring |
| NFR-01.6 | Halaman katalog dengan 50+ motor harus dimuat **tanpa lag** yang terasa | < 2 detik | Manual testing |
| NFR-01.7 | **Lighthouse Performance Score** | ≥ 85 | Google Lighthouse |
| NFR-01.8 | Ukuran **bundle JavaScript** | < 200 KB (gzipped) | Build tool |

---

## NFR-02: Keamanan (Security)

| Atribut | Detail |
|---|---|
| **ID** | NFR-02 |
| **Kategori** | Security |
| **Prioritas** | 🔴 High |

| No | Kebutuhan | Detail |
|---|---|---|
| NFR-02.1 | **Enkripsi password** menggunakan bcrypt dengan cost factor ≥ 10 | Hash & salt setiap password |
| NFR-02.2 | **HTTPS** wajib di semua halaman | SSL/TLS certificate valid |
| NFR-02.3 | **Proteksi SQL Injection** menggunakan parameterized queries / ORM | Tidak ada raw query tanpa sanitasi |
| NFR-02.4 | **Proteksi XSS** (Cross-Site Scripting) | Escape semua output HTML, Content Security Policy |
| NFR-02.5 | **Proteksi CSRF** (Cross-Site Request Forgery) | Token CSRF pada setiap form |
| NFR-02.6 | **Rate Limiting** untuk endpoint login | Maks 5 percobaan per menit per IP |
| NFR-02.7 | **Rate Limiting** untuk API public | Maks 100 request per menit per IP |
| NFR-02.8 | **Enkripsi data sensitif** (foto KTP/SIM) saat disimpan (at rest) | AES-256 encryption |
| NFR-02.9 | **Akses data KTP/SIM** hanya untuk admin yang terverifikasi | Role-based access control |
| NFR-02.10 | **Session management** dengan token JWT yang memiliki expiry time | Access token: 15 menit, Refresh token: 7 hari |
| NFR-02.11 | **Input validation** di sisi client dan server | Whitelist validation, sanitize input |
| NFR-02.12 | **Secure file upload** — validasi tipe file, ukuran, dan scan malware | Hanya JPG/PNG, max 5MB |

---

## NFR-03: Keandalan & Ketersediaan (Reliability & Availability)

| Atribut | Detail |
|---|---|
| **ID** | NFR-03 |
| **Kategori** | Reliability |
| **Prioritas** | 🔴 High |

| No | Kebutuhan | Target |
|---|---|---|
| NFR-03.1 | **Uptime** sistem | ≥ 99.5% per bulan |
| NFR-03.2 | **Recovery Time Objective (RTO)** | < 1 jam |
| NFR-03.3 | **Recovery Point Objective (RPO)** | < 15 menit (data loss terakhir) |
| NFR-03.4 | **Backup database** otomatis | Setiap 6 jam |
| NFR-03.5 | **Backup file** (foto motor, KTP) | Setiap 24 jam |
| NFR-03.6 | Sistem harus menangani **error gracefully** tanpa crash | Custom error pages, error logging |
| NFR-03.7 | **Monitoring** sistem dengan alerting | Notifikasi jika server down > 5 menit |

---

## NFR-04: Skalabilitas (Scalability)

| Atribut | Detail |
|---|---|
| **ID** | NFR-04 |
| **Kategori** | Scalability |
| **Prioritas** | 🟡 Medium |

| No | Kebutuhan | Target |
|---|---|---|
| NFR-04.1 | Sistem harus menangani **100 concurrent users** tanpa degradasi performa | Response time tetap < 500ms |
| NFR-04.2 | Database harus mendukung **10.000+ data motor** | Query time tetap < 300ms |
| NFR-04.3 | Sistem harus mendukung **penambahan lokasi baru** tanpa perubahan arsitektur | Konfigurasi via admin panel |
| NFR-04.4 | **Aset statis** (gambar) disajikan melalui CDN | Cache hit ratio > 90% |
| NFR-04.5 | Arsitektur harus mendukung **horizontal scaling** | Stateless API, external session store |

---

## NFR-05: Usability (Kemudahan Penggunaan)

| Atribut | Detail |
|---|---|
| **ID** | NFR-05 |
| **Kategori** | Usability |
| **Prioritas** | 🔴 High |

| No | Kebutuhan | Target |
|---|---|---|
| NFR-05.1 | User baru harus bisa **menyelesaikan booking pertama** dalam < 5 menit | Usability testing |
| NFR-05.2 | **Desain responsif** — tampilan optimal di viewport 320px s/d 1920px | Mobile, tablet, desktop |
| NFR-05.3 | **Navigasi intuitif** — user menemukan fitur yang dicari dalam < 3 klik | Usability testing |
| NFR-05.4 | **Feedback visual** untuk setiap aksi user (loading, sukses, error) | Toast notification, spinner |
| NFR-05.5 | **Form validation** real-time dengan pesan error yang jelas dan spesifik | Inline validation |
| NFR-05.6 | **Konsistensi desain** — warna, tipografi, spacing seragam di seluruh halaman | Design system |
| NFR-05.7 | **Empty state** yang informatif ketika tidak ada data | Ilustrasi + pesan + CTA |

---

## NFR-06: Aksesibilitas (Accessibility)

| Atribut | Detail |
|---|---|
| **ID** | NFR-06 |
| **Kategori** | Accessibility |
| **Prioritas** | 🟡 Medium |

| No | Kebutuhan | Target |
|---|---|---|
| NFR-06.1 | Konformitas **WCAG 2.1 Level AA** | Audit accessibility |
| NFR-06.2 | Semua elemen interaktif **navigable via keyboard** (Tab, Enter, Escape) | Manual testing |
| NFR-06.3 | Semua gambar memiliki **alt text** yang deskriptif | HTML validation |
| NFR-06.4 | **Kontras warna** minimum 4.5:1 untuk teks normal, 3:1 untuk teks besar | Color contrast checker |
| NFR-06.5 | **ARIA labels** pada elemen interaktif yang tidak memiliki label visible | Screen reader testing |
| NFR-06.6 | **Focus indicator** yang jelas pada elemen yang sedang difokuskan | Visual testing |
| NFR-06.7 | Formulir memiliki **label** yang terhubung dengan input | HTML validation |

---

## NFR-07: Kompatibilitas (Compatibility)

| Atribut | Detail |
|---|---|
| **ID** | NFR-07 |
| **Kategori** | Compatibility |
| **Prioritas** | 🟡 Medium |

| No | Kebutuhan | Target |
|---|---|---|
| NFR-07.1 | Support **browser**: Chrome (latest - 2), Firefox (latest - 2), Safari (latest - 2), Edge (latest - 2) | Cross-browser testing |
| NFR-07.2 | Support **OS mobile**: Android 10+, iOS 14+ | Device testing |
| NFR-07.3 | Tampilan benar pada **resolusi layar**: 320px, 768px, 1024px, 1440px, 1920px | Responsive testing |
| NFR-07.4 | **Tidak bergantung** pada plugin browser (Flash, Java Applet, dll) | Standard web technologies |

---

## NFR-08: Maintainability (Kemudahan Pemeliharaan)

| Atribut | Detail |
|---|---|
| **ID** | NFR-08 |
| **Kategori** | Maintainability |
| **Prioritas** | 🟡 Medium |

| No | Kebutuhan | Target |
|---|---|---|
| NFR-08.1 | **Kode terstruktur** dengan prinsip separation of concerns | Code review |
| NFR-08.2 | **Dokumentasi kode** — komentar untuk logika kompleks, README untuk setup | Code review |
| NFR-08.3 | **Penamaan** variabel, fungsi, dan file yang konsisten dan deskriptif | Coding convention |
| NFR-08.4 | **Version control** menggunakan Git dengan branching strategy | Git Flow / GitHub Flow |
| NFR-08.5 | **Environment configuration** terpisah (development, staging, production) | `.env` files |
| NFR-08.6 | **Dependency management** — semua dependency terdokumentasi dan versi terkunci | `package.json` / `composer.json` |

---

## NFR-09: Kepatuhan Hukum (Legal & Compliance)

| Atribut | Detail |
|---|---|
| **ID** | NFR-09 |
| **Kategori** | Legal |
| **Prioritas** | 🟡 Medium |

| No | Kebutuhan | Detail |
|---|---|---|
| NFR-09.1 | **Kebijakan Privasi** yang jelas dan dapat diakses dari semua halaman | Halaman khusus kebijakan privasi |
| NFR-09.2 | **Syarat & Ketentuan** layanan yang lengkap | Halaman khusus S&K |
| NFR-09.3 | **Consent** — persetujuan eksplisit sebelum pengumpulan data pribadi | Checkbox saat registrasi |
| NFR-09.4 | Kepatuhan terhadap **UU PDP** (Undang-Undang Pelindungan Data Pribadi) Indonesia | Data handling policy |
| NFR-09.5 | **Hak pengguna** untuk meminta penghapusan data akun | Fitur delete account |

---

## Matriks Ringkasan

### Functional Requirements
| ID | Modul | Total Sub-Requirements | Prioritas |
|---|---|---|---|
| FR-01 | Autentikasi | 7 | 🔴 High |
| FR-02 | Profil Pengguna | 6 | 🔴 High |
| FR-03 | Katalog & Pencarian | 10 | 🔴 High |
| FR-04 | Detail Motor | 8 | 🔴 High |
| FR-05 | Pemesanan | 10 | 🔴 High |
| FR-06 | Pembayaran | 9 | 🔴 High |
| FR-07 | Dashboard Pelanggan | 7 | 🔴 High |
| FR-08 | Review & Rating | 5 | 🟡 Medium |
| FR-09 | Panel Admin | 9 | 🔴 High |
| FR-10 | Notifikasi | 7 | 🔴 High |
| | **TOTAL** | **78** | |

### Non-Functional Requirements
| ID | Kategori | Total Sub-Requirements | Prioritas |
|---|---|---|---|
| NFR-01 | Performa | 8 | 🔴 High |
| NFR-02 | Keamanan | 12 | 🔴 High |
| NFR-03 | Keandalan | 7 | 🔴 High |
| NFR-04 | Skalabilitas | 5 | 🟡 Medium |
| NFR-05 | Usability | 7 | 🔴 High |
| NFR-06 | Aksesibilitas | 7 | 🟡 Medium |
| NFR-07 | Kompatibilitas | 4 | 🟡 Medium |
| NFR-08 | Maintainability | 6 | 🟡 Medium |
| NFR-09 | Legal & Compliance | 5 | 🟡 Medium |
| | **TOTAL** | **61** | |

---

> **Total keseluruhan: 78 Functional Requirements + 61 Non-Functional Requirements = 139 Requirements**
