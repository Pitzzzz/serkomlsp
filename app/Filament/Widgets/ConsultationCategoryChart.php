<?php

namespace App\Filament\Widgets;

use App\Models\Consultation;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Str;

class ConsultationCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Konsultasi per kategori layanan';

    protected static ?string $description = 'Jumlah permintaan konsultasi yang masuk untuk setiap kategori.';

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $counts = Consultation::query()
            ->leftJoin('products', 'consultations.product_id', '=', 'products.id')
            ->selectRaw('products.label as product_label, COUNT(consultations.id) as total')
            ->groupBy('products.label')
            ->get()
            ->reduce(function (array $counts, object $row): array {
                $label = trim((string) $row->product_label);
                $category = $label === ''
                    ? 'Lainnya'
                    : trim(Str::after($label, '/'));

                if ($category === '') {
                    $category = 'Lainnya';
                }

                $counts[$category] = ($counts[$category] ?? 0) + (int) $row->total;

                return $counts;
            }, []);

        uksort($counts, static function (string $left, string $right) use (&$counts): int {
            return ($counts[$right] <=> $counts[$left]) ?: strcasecmp($left, $right);
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah konsultasi',
                    'data' => array_values($counts),
                    'borderColor' => '#ff2a4b',
                    'backgroundColor' => 'rgba(255, 42, 75, 0.15)',
                    'fill' => true,
                    'tension' => 0.3,
                    'pointBackgroundColor' => '#ff2a4b',
                    'pointRadius' => 4,
                ],
            ],
            'labels' => array_keys($counts),
        ];
    }

    protected function getOptions(): ?array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
