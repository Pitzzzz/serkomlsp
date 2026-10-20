<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        SeederImages::publish();

        User::query()->updateOrCreate(
            ['email' => 'admin@serkom.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ],
        );

        $defaults = [
            'company_name' => 'PT Solusi Koneksi Anda',
            'contact_email' => 'info@solusikoneksianda.example',
            'contact_phone' => '(0251) 000-0000',
            'contact_phone_href' => '02510000000',
            'contact_address' => 'Jl. Raya Bogor, Jawa Barat 16111, Indonesia',
            'contact_city' => 'Bogor, Jawa Barat',
            'working_hours' => 'Senin–Jumat, 08.00–17.00 WIB',
            'office_image' => SeederImages::urlForIndex(1),
            'office_coords' => '6.59°S 106.79°E',
            'support_note' => 'Kanal prioritas untuk klien dengan paket perawatan.',
            'legal_note' => 'PT Solusi Koneksi Anda · terdaftar sejak 2018.',
        ];

        foreach ($defaults as $key => $value) {
            SiteSetting::setValue($key, $value);
        }
    }
}
