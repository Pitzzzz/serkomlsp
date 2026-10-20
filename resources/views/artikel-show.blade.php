@extends('layouts.app')

@section('title', $article->title.' — PT Solusi Koneksi Anda')

@section('content')
<main class="w-full bg-[#0e0e10] min-h-screen">
    <article class="flex flex-col w-full text-on-surface overflow-hidden">

        <header class="w-full border-b border-[#201f21]">
            <div class="max-w-3xl mx-auto px-margin-mobile lg:px-margin pt-28 lg:pt-32 pb-space-xl">
                <a class="inline-flex items-center gap-1.5 font-tech-code text-body-sm text-[#a1a1aa] hover:text-white transition-colors mb-space-lg" href="{{ route('artikel') }}">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    <span>Semua artikel</span>
                </a>
                <div class="font-tech-code text-body-sm text-[#ff2a4b] mb-space-md">{{ $article->category }} · {{ $article->reading_minutes }} menit baca</div>
                <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl text-white tracking-tight">{{ $article->title }}</h1>
                <p class="mt-space-md font-body-lg text-body-lg text-[#a1a1aa] leading-relaxed">{{ $article->excerpt }}</p>
                <div class="mt-space-lg flex items-center gap-space-md font-tech-code text-body-sm text-[#6b6b70]">
                    <span>{{ $article->formattedDate() }}</span>
                    <span class="text-[#353437]">·</span>
                    <span>PT Solusi Koneksi Anda</span>
                </div>
            </div>
        </header>

        @if ($article->coverSrc())
        <figure class="w-full max-w-5xl mx-auto px-margin-mobile lg:px-margin pt-space-xl">
            <div class="overflow-hidden border border-[#26262a] bg-[#131315] aspect-[16/9]">
                <img alt="{{ $article->title }}" class="w-full h-full object-cover" src="{{ $article->coverSrc() }}" />
            </div>
        </figure>
        @endif

        <div class="w-full max-w-3xl mx-auto px-margin-mobile lg:px-margin py-space-xl">
            <div class="article-body font-body-md text-body-md text-[#c4c4cc] leading-[1.8] [&_p]:mb-space-lg [&_h2]:font-headline-md [&_h2]:text-headline-md [&_h2]:text-white [&_h2]:mt-space-xl [&_h2]:mb-space-md [&_ul]:mb-space-lg [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-2 [&_li]:text-[#c4c4cc]">
                {!! $article->body !!}
            </div>
        </div>

        @if ($related->isNotEmpty())
        <section class="w-full max-w-3xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '02', 'title' => 'Artikel terkait'])
            <div class="divide-y divide-[#201f21] border-b border-[#201f21]">
                @foreach ($related as $item)
                <a class="group grid grid-cols-1 sm:grid-cols-12 gap-space-sm py-space-lg items-baseline" href="{{ route('artikel.show', $item) }}">
                    <span class="sm:col-span-3 font-tech-code text-body-sm text-[#a1a1aa]">{{ $item->formattedDate() }}</span>
                    <span class="sm:col-span-9 font-headline-sm text-headline-sm text-white group-hover:text-[#ff2a4b] transition-colors">{{ $item->title }}</span>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        @include('partials.cta')
    </article>
</main>
@endsection