<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale(config('app.locale', 'id'));

        View::composer(['partials.footer', 'layouts.app'], function ($view): void {
            $contact = Schema::hasTable('site_settings')
                ? SiteSetting::contact()
                : [
                    'company_name' => 'PT Solusi Koneksi Anda',
                    'email' => 'info@solusikoneksianda.example',
                    'phone' => '(0251) 000-0000',
                    'phone_href' => '02510000000',
                    'city' => 'Bogor, Jawa Barat',
                    'office_coords' => '6.59°S 106.79°E',
                ];

            $view->with('siteContact', $contact);
        });
    }
}
