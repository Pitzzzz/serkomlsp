<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue(string $key, ?string $default = null): ?string
    {
        return Cache::rememberForever('site_setting.'.$key, function () use ($key, $default) {
            $setting = static::query()->where('key', $key)->first();

            return $setting?->value ?? $default;
        });
    }

    public static function setValue(string $key, ?string $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value],
        );

        Cache::forget('site_setting.'.$key);
    }

    public static function contact(): array
    {
        return [
            'company_name' => static::getValue('company_name', 'PT Solusi Koneksi Anda'),
            'email' => static::getValue('contact_email', 'info@solusikoneksianda.example'),
            'phone' => static::getValue('contact_phone', '(0251) 000-0000'),
            'phone_href' => static::getValue('contact_phone_href', '02510000000'),
            'address' => static::getValue('contact_address', 'Jl. Raya Bogor, Jawa Barat 16111, Indonesia'),
            'city' => static::getValue('contact_city', 'Bogor, Jawa Barat'),
            'working_hours' => static::getValue('working_hours', 'Senin–Jumat, 08.00–17.00 WIB'),
            'office_image' => static::getValue('office_image', '/gambar/pexels-ian-r-111881-34522994.jpg'),
            'office_coords' => static::getValue('office_coords', '6.59°S 106.79°E'),
            'support_note' => static::getValue('support_note', 'Kanal prioritas untuk klien dengan paket perawatan.'),
            'legal_note' => static::getValue('legal_note', 'PT Solusi Koneksi Anda · terdaftar sejak 2018.'),
        ];
    }
}
