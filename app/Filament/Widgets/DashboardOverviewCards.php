<?php

namespace App\Filament\Widgets;

use App\Models\AdminReply;
use App\Models\Article;
use App\Models\Consultation;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverviewCards extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Produk', Product::query()->count())
                ->description('Total produk layanan')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),
            Stat::make('Konsultasi', Consultation::query()->count())
                ->description('Total permintaan konsultasi')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('warning'),
            Stat::make('Pesan kontak', ContactMessage::query()->count())
                ->description('Total pesan yang masuk')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('info'),
            Stat::make('Artikel', Article::query()->count())
                ->description('Total artikel')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
            Stat::make('Galeri', GalleryItem::query()->count())
                ->description('Total dokumentasi')
                ->descriptionIcon('heroicon-m-photo')
                ->color('success'),
            Stat::make('Balasan email', AdminReply::query()->count())
                ->description('Total email balasan terkirim')
                ->descriptionIcon('heroicon-m-paper-airplane')
                ->color('primary'),
        ];
    }
}
