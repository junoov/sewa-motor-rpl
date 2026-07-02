<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Location;
use App\Models\Motor;
use App\Models\MotorType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotoRentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@motorent.test'],
            [
                'name' => 'Admin MotoRent',
                'phone' => '081234567890',
                'role' => 'admin',
                'verification_status' => 'terverifikasi',
                'password' => Hash::make('Admin12345'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'pelanggan@motorent.test'],
            [
                'name' => 'Pelanggan Demo',
                'phone' => '089876543210',
                'role' => 'customer',
                'verification_status' => 'terverifikasi',
                'password' => Hash::make('User12345'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'checkout@motorent.test'],
            [
                'name' => 'Akun Checkout Demo',
                'phone' => '081122334455',
                'role' => 'customer',
                'address' => 'Jl. Demo Checkout No. 1, Jakarta',
                'verification_status' => 'terverifikasi',
                'password' => Hash::make('Checkout12345'),
            ]
        );

        $locations = collect([
            ['name' => 'MotoRent Jakarta Pusat', 'city' => 'Jakarta', 'province' => 'DKI Jakarta', 'address' => 'Jl. Sudirman No. 10'],
            ['name' => 'MotoRent Yogyakarta', 'city' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'address' => 'Jl. Malioboro No. 21'],
            ['name' => 'MotoRent Bali', 'city' => 'Bali', 'province' => 'Bali', 'address' => 'Jl. Sunset Road No. 8'],
        ])->mapWithKeys(fn (array $location) => [
            $location['city'] => Location::updateOrCreate(['city' => $location['city']], $location),
        ]);

        $brands = collect([
            ['name' => 'Honda', 'logo_path' => 'assets/logos/honda.svg'],
            ['name' => 'Yamaha', 'logo_path' => 'assets/logos/yamaha.svg'],
            ['name' => 'Suzuki', 'logo_path' => 'assets/logos/suzuki.svg'],
            ['name' => 'Kawasaki', 'logo_path' => 'assets/logos/kawasaki.svg'],
            ['name' => 'Vespa', 'logo_path' => 'assets/logos/vespa.svg'],
            ['name' => 'KTM', 'logo_path' => 'assets/logos/ktm.svg'],
            ['name' => 'Benelli', 'logo_path' => 'assets/logos/benelli.svg'],
            ['name' => 'TVS', 'logo_path' => 'assets/logos/tvs.png'],
        ])->mapWithKeys(fn (array $brand) => [
            $brand['name'] => Brand::updateOrCreate(
                ['slug' => Str::slug($brand['name'])],
                ['name' => $brand['name'], 'logo_path' => $brand['logo_path']]
            ),
        ]);

        $types = collect(['Matic', 'Sport', 'Naked', 'Trail', 'Classic'])->mapWithKeys(fn (string $type) => [
            $type => MotorType::updateOrCreate(['slug' => Str::slug($type)], ['name' => $type]),
        ]);

        $motors = [
            ['Honda Beat', 'Honda', 'Matic', 'Jakarta', 'assets/motors/honda-beat-main-gallery-transparent.png', 2023, 110, 'Matic', 55000, 300000, 4.7, 80, 'blue', false],
            ['Honda Vario 125', 'Honda', 'Matic', 'Jakarta', 'assets/motors/honda-vario-125-cutout.png', 2024, 125, 'Matic', 70000, 350000, 4.9, 120, 'blue', true],
            ['Yamaha Aerox 155', 'Yamaha', 'Matic', 'Yogyakarta', 'assets/motors/yamaha-aerox-155-main-gallery-transparent.png', 2023, 155, 'Matic', 85000, 400000, 4.8, 70, 'mint', false],
            ['Yamaha NMAX 155', 'Yamaha', 'Matic', 'Bali', 'assets/motors/yamaha-nmax-155-main-gallery-transparent.png', 2024, 155, 'Matic', 90000, 450000, 4.8, 95, 'mint', true],
            ['Kawasaki Z250', 'Kawasaki', 'Naked', 'Jakarta', 'assets/motors/kawasaki-z250-main-gallery-transparent.png', 2022, 250, 'Manual', 150000, 700000, 4.9, 65, 'cream', false],
            ['Kawasaki KLX', 'Kawasaki', 'Trail', 'Yogyakarta', 'assets/motors/kawasaki-klx-main-gallery-transparent.png', 2022, 150, 'Manual', 130000, 600000, 4.7, 44, 'cream', false],
            ['Vespa Sprint', 'Vespa', 'Classic', 'Bali', 'assets/motors/vespa-sprint-cutout.png', 2023, 150, 'Matic', 120000, 600000, 4.9, 45, 'lavender', true],
            ['Benelli Imperiale', 'Benelli', 'Classic', 'Jakarta', 'assets/motors/benelli-imperiale-cutout.png', 2021, 374, 'Manual', 180000, 900000, 4.8, 38, 'lavender', false],
        ];

        foreach ($motors as [$name, $brand, $type, $city, $image, $year, $cc, $transmission, $price, $deposit, $rating, $reviews, $tone, $popular]) {
            Motor::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'brand_id' => $brands[$brand]->id,
                    'motor_type_id' => $types[$type]->id,
                    'location_id' => $locations[$city]->id,
                    'name' => $name,
                    'image_path' => $image,
                    'year' => $year,
                    'cc' => $cc,
                    'transmission' => $transmission,
                    'plate_number_masked' => 'B **** MR',
                    'price_per_day' => $price,
                    'deposit_amount' => $deposit,
                    'rating' => $rating,
                    'reviews_count' => $reviews,
                    'status' => 'tersedia',
                    'tone' => $tone,
                    'description' => 'Motor terawat, bersih, dan siap dipakai untuk perjalanan harian maupun liburan.',
                    'is_popular' => $popular,
                ]
            );
        }
    }
}
