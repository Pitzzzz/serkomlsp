@extends('layouts.app')

@section('title', 'Artikel — PT Solusi Koneksi Anda')

@section('content')
<main class="w-full bg-[#0e0e10] min-h-screen">
    <div class="flex flex-col w-full text-on-surface overflow-hidden">
        @include('partials.page-header', [
        'index' => '05',
        'eyebrow' => 'Artikel',
        'title' => 'Catatan dari tim kami',
        'description' => 'Hal-hal praktis seputar siklus pengembangan perangkat lunak, arsitektur data, dan keputusan yang sering dihadapi klien sebelum memulai proyek.',
        ])

        @if ($featured)
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-xl pb-space-xl">
            @include('partials.section-head', ['index' => '01', 'title' => 'Sorotan', 'meta' => $featured->formattedDate()])
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl lg:gap-16 items-center">
                @if ($featured->coverSrc())
                <div class="lg:col-span-5">
                    <div class="overflow-hidden border border-[#26262a] bg-[#131315] aspect-[4/3]">
                        <img alt="{{ $featured->title }}" class="w-full h-full object-cover" src="{{ $featured->coverSrc() }}" />
                    </div>
                </div>
                @endif
                <div class="{{ $featured->coverSrc() ? 'lg:col-span-7' : 'lg:col-span-12' }}">
                    <div class="font-tech-code text-body-sm text-[#ff2a4b] mb-space-sm">{{ $featured->category }} · {{ $featured->reading_minutes }} menit baca</div>
                    <h2 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl text-white tracking-tight mb-space-md">{{ $featured->title }}</h2>
                    <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed max-w-2xl mb-space-lg">{{ $featured->excerpt }}</p>
                    <a class="inline-flex items-center gap-2 font-tech-badge text-tech-badge uppercase tracking-wider text-white border-b border-[#2a2a2c] hover:border-[#ff2a4b] hover:text-[#ff2a4b] transition-colors pb-1" href="{{ route('artikel.show', $featured) }}">
                        <span>Baca artikel</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </section>
        @endif

        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '02', 'title' => 'Semua artikel', 'meta' => $articles->count().' tulisan'])
            <div class="divide-y divide-[#201f21] border-b border-[#201f21]">
                @forelse ($articles as $article)
                <a class="group grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline" href="{{ route('artikel.show', $article) }}">
                    <span class="lg:col-span-2 font-tech-code text-body-sm text-[#a1a1aa]">{{ $article->formattedDate() }}</span>
                    <span class="lg:col-span-7 font-headline-sm text-headline-sm text-white group-hover:text-[#ff2a4b] transition-colors">{{ $article->title }}</span>
                    <span class="lg:col-span-3 font-tech-code text-body-sm text-[#a1a1aa] lg:text-right">{{ $article->metaLabel() }}</span>
                </a>
                @empty
                <p class="py-space-lg font-body-md text-body-md text-[#a1a1aa]">Belum ada artikel lain.</p>
                @endforelse
            </div>
        </section>

        @include('partials.cta')
    </div>
</main>
@endsection