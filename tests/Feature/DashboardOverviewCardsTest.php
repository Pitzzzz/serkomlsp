<?php

namespace Tests\Feature;

use App\Filament\Widgets\DashboardOverviewCards;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use ReflectionMethod;
use Tests\TestCase;

class DashboardOverviewCardsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');

        foreach (['products', 'consultations', 'contact_messages', 'articles', 'gallery_items', 'admin_replies'] as $table) {
            Schema::create($table, function (Blueprint $table): void {
                $table->id();
                $table->string('placeholder')->nullable();
            });
        }
    }

    public function test_it_shows_total_counts_for_dashboard_data(): void
    {
        DB::table('products')->insert([['placeholder' => 'a'], ['placeholder' => 'b'], ['placeholder' => 'c']]);
        DB::table('consultations')->insert([['placeholder' => 'a'], ['placeholder' => 'b']]);
        DB::table('articles')->insert([['placeholder' => 'a']]);
        DB::table('gallery_items')->insert([
            ['placeholder' => 'a'],
            ['placeholder' => 'b'],
            ['placeholder' => 'c'],
            ['placeholder' => 'd'],
        ]);
        DB::table('admin_replies')->insert([['placeholder' => 'a']]);

        $method = new ReflectionMethod(DashboardOverviewCards::class, 'getStats');
        $stats = $method->invoke(app(DashboardOverviewCards::class));

        $actual = collect($stats)->mapWithKeys(
            fn ($stat): array => [$stat->getLabel() => $stat->getValue()],
        )->all();

        $this->assertSame([
            'Produk' => 3,
            'Konsultasi' => 2,
            'Pesan kontak' => 0,
            'Artikel' => 1,
            'Galeri' => 4,
            'Balasan email' => 1,
        ], $actual);
    }
}
