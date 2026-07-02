# MotoRent - Laravel + MySQL

Project ini sudah diubah dari static UI menjadi aplikasi Laravel ringan sesuai PRD/FR-NFR. UI utama tetap mengikuti desain existing dari `index.html`, `script.js`, dan aset di `assets/`, tetapi styling sekarang sudah dimigrasikan ke Tailwind lokal via Vite.

## Stack

- Laravel 12 + Blade
- MySQL
- Tailwind CSS lokal via Vite
- JavaScript ringan dari UI existing
- Auth session bawaan Laravel, tanpa Jetstream/Livewire/Inertia

## Setup lokal

1. Buat database MySQL:

```sql
CREATE DATABASE sewa_motor_rpl CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Install dependency jika belum ada:

```bash
composer install
npm install
```

3. Pastikan `.env` memakai MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sewa_motor_rpl
DB_USERNAME=root
DB_PASSWORD=
```

4. Jalankan migrasi dan seed data awal:

```bash
php artisan migrate:fresh --seed
```

5. Jalankan server:

```bash
php artisan serve
```

## Akun demo

- Admin: `admin@motorent.test` / `Admin12345`
- Pelanggan: `pelanggan@motorent.test` / `User12345`
- Checkout: `checkout@motorent.test` / `Checkout12345`

Kalau hanya butuh dump akun tanpa reset data lain, import:

```bash
mysql -u root sewa_motor_rpl < database/dumps/demo_accounts.sql
```

## Fitur yang sudah tersedia

- Landing page mengikuti UI/UX existing dengan Tailwind
- Katalog motor dengan filter merek, tipe, lokasi, sorting
- Detail motor
- Register, login, logout
- Booking motor dengan validasi tanggal dan total otomatis
- Riwayat/detail booking pelanggan
- Dashboard admin ringkas
- Seeder data brand, lokasi, motor, admin, dan pelanggan

## Catatan scope

Payment gateway, upload bukti pembayaran, upload KTP/SIM, dan CRUD admin penuh sudah disiapkan dari sisi struktur data dasar, tetapi belum dibuat menjadi workflow lengkap agar project tetap ringan untuk tahap awal RPL.

## Frontend build

```bash
npm install
npm run dev
```

Untuk production build:

```bash
npm run build
```
