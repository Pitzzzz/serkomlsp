<?php

namespace Tests\Feature;

use App\Filament\Widgets\ConsultationCategoryChart;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use ReflectionMethod;
use Tests\TestCase;

class ConsultationCategoryChartTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');

        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->string('label');
        });

        Schema::create('consultations', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
        });
    }

    public function test_it_counts_consultations_by_product_category(): void
    {
        $website = DB::table('products')->insertGetId(['label' => '01 / Website']);
        $webApplications = DB::table('products')->insertGetId(['label' => '05 / Website']);
        $mobileApplications = DB::table('products')->insertGetId(['label' => '02 / Aplikasi']);

        DB::table('consultations')->insert([
            ['product_id' => $website],
            ['product_id' => $webApplications],
            ['product_id' => $website],
            ['product_id' => $mobileApplications],
            ['product_id' => null],
        ]);

        $method = new ReflectionMethod(ConsultationCategoryChart::class, 'getData');
        $data = $method->invoke(app(ConsultationCategoryChart::class));

        $this->assertSame(['Website', 'Aplikasi', 'Lainnya'], $data['labels']);
        $this->assertSame([3, 1, 1], $data['datasets'][0]['data']);
    }

    public function test_it_uses_a_line_chart(): void
    {
        $method = new ReflectionMethod(ConsultationCategoryChart::class, 'getType');

        $this->assertSame('line', $method->invoke(app(ConsultationCategoryChart::class)));
    }
}
