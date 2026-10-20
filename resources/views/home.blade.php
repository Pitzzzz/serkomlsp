@extends('layouts.app')

@section('title', 'Beranda — PT Solusi Koneksi Anda')

@section('content')
@php
$heroCards = $products->map(fn ($p) => [
'name' => $p->name,
'description' => $p->description,
'features' => collect($p->features)->take(2)->values()->all(),
'price' => $p->formattedPrice(),
'url' => $p->consultationUrl(),
'label' => $p->label,
])->values();
@endphp
<style>
    @keyframes home-rise {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes home-image {
        from {
            opacity: 0;
            transform: scale(1.06);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes home-card-in {
        from {
            opacity: 0;
            transform: translateY(32px) rotate(-4deg) scale(0.94);
        }

        to {
            opacity: 1;
            transform: translateY(0) rotate(-3deg) scale(1);
        }
    }

    @keyframes home-card-in-alt {
        from {
            opacity: 0;
            transform: translateY(40px) rotate(6deg) scale(0.92);
        }

        to {
            opacity: 1;
            transform: translateY(0) rotate(4deg) scale(1);
        }
    }

    @keyframes home-card-float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-9px);
        }
    }

    @keyframes home-card-float-alt {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-7px);
        }
    }

    .home-hero__media {
        animation: home-image 1.4s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .home-hero__brand {
        animation: home-rise 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s both;
    }

    .home-hero__line {
        animation: home-rise 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s both;
    }

    .home-hero__actions {
        animation: home-rise 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.45s both;
    }

    .home-hero__stack {
        position: relative;
        width: 100%;
        max-width: 420px;
        min-height: 380px;
        margin-inline: auto;
    }

    @media (min-width: 1024px) {
        .home-hero__stack {
            margin-inline: auto 0;
            min-height: 400px;
        }
    }

    .home-hero__card-wrap {
        position: absolute;
        width: min(78%, 290px);
        transition: z-index 0s, filter 200ms ease;
    }

    .home-hero__card-wrap--a {
        top: 0;
        left: 0;
        z-index: 2;
        animation: home-card-in 1s cubic-bezier(0.22, 1, 0.36, 1) 0.3s both;
    }

    .home-hero__card-wrap--b {
        top: 72px;
        right: 0;
        left: auto;
        z-index: 1;
        animation: home-card-in-alt 1s cubic-bezier(0.22, 1, 0.36, 1) 0.48s both;
    }

    .home-hero__card-wrap:hover {
        z-index: 3;
    }

    .home-hero__card-wrap--b:not(:hover) {
        filter: brightness(0.92);
    }

    .home-hero__card-float {
        transform-style: preserve-3d;
    }

    .home-hero__card-float--a {
        animation: home-card-float 5.5s ease-in-out 1.4s infinite;
    }

    .home-hero__card-float--b {
        animation: home-card-float-alt 6.4s ease-in-out 1.7s infinite;
    }

    .home-hero__card {
        transition: transform 200ms ease-out, box-shadow 200ms ease;
        will-change: transform;
    }

    .home-hero__card--a {
        transform: rotate(-3deg);
    }

    .home-hero__card--b {
        transform: rotate(4deg);
    }

    .home-hero__card-wrap:hover .home-hero__card--a,
    .home-hero__card-wrap:hover .home-hero__card--b {
        transform: rotate(0deg) translateY(-4px);
    }

    .home-hero__card-face {
        background:
            linear-gradient(145deg, rgba(255, 255, 255, 0.10) 0%, rgba(255, 255, 255, 0.02) 42%, rgba(255, 42, 75, 0.12) 100%),
            rgba(18, 18, 22, 0.88);
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow:
            0 30px 60px rgba(0, 0, 0, 0.55),
            0 0 0 1px rgba(255, 42, 75, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .home-hero__card-glow {
        position: absolute;
        inset: -18% -8% auto auto;
        width: 55%;
        height: 55%;
        background: radial-gradient(circle, rgba(255, 42, 75, 0.45), transparent 70%);
        filter: blur(28px);
        pointer-events: none;
        z-index: -1;
    }

    .home-hero__swap {
        transition: opacity 280ms ease, transform 280ms ease;
    }

    .home-hero__swap.is-out {
        opacity: 0;
        transform: translateY(8px);
    }

    @media (max-width: 639px) {
        .home-hero__stack {
            min-height: 340px;
            max-width: 340px;
        }

        .home-hero__card-wrap {
            width: min(82%, 260px);
        }

        .home-hero__card-wrap--b {
            top: 56px;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .home-hero__media,
        .home-hero__brand,
        .home-hero__line,
        .home-hero__actions,
        .home-hero__card-wrap--a,
        .home-hero__card-wrap--b,
        .home-hero__card-float--a,
        .home-hero__card-float--b {
            animation: none;
        }

        .home-hero__card--a,
        .home-hero__card--b,
        .home-hero__card-wrap:hover .home-hero__card--a,
        .home-hero__card-wrap:hover .home-hero__card--b {
            transform: none;
        }
    }
</style>

<main class="w-full bg-[#0e0e10] min-h-screen">
    <div class="flex flex-col w-full text-on-surface overflow-hidden">

        {{-- HERO: brand + CTA kiri, kartu 3D kanan menimpa background --}}
        <section class="relative w-full min-h-[100svh] flex items-center overflow-hidden">
            <div class="absolute inset-0">
                <img
                    alt=""
                    aria-hidden="true"
                    class="home-hero__media w-full h-full object-cover object-center"
                    src="{{ asset('gambar/pexels-ian-r-111881-34522994.jpg') }}" />
                <div class="absolute inset-0 bg-gradient-to-t from-[#0e0e10] via-[#0e0e10]/70 to-[#0e0e10]/40"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#0e0e10]/92 via-[#0e0e10]/55 to-[#0e0e10]/20"></div>
            </div>

            <div class="relative z-10 w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-28 pb-16 lg:pt-32 lg:pb-20">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
                    {{-- Teks --}}
                    <div class="lg:col-span-6 xl:col-span-6">
                        <p class="home-hero__brand font-display-hero font-bold text-white tracking-[-0.04em] text-[36px] leading-[40px] sm:text-[48px] sm:leading-[50px] lg:text-[58px] lg:leading-[60px] max-w-xl">
                            PT Solusi Koneksi Anda
                        </p>
                        <p class="home-hero__line mt-space-md font-body-lg text-body-lg text-[#d4d4d8] max-w-lg leading-relaxed">
                            Software house di Bogor. Website, aplikasi mobile, dan sistem informasi yang dipakai bisnis setiap hari.
                        </p>
                        <div class="home-hero__actions mt-space-xl flex flex-col sm:flex-row items-stretch sm:items-center gap-space-md">
                            <a class="px-7 py-3.5 rounded-xl bg-[#ff2a4b] text-white font-tech-badge text-tech-badge uppercase tracking-widest hover:bg-[#d6012e] transition-colors flex items-center justify-center gap-2" data-path="konsultasi" href="{{ url('/konsultasi') }}">
                                <span>Mulai konsultasi</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                            <a class="px-7 py-3.5 rounded-xl border border-white/25 text-white hover:border-[#ff2a4b] hover:text-[#ff2a4b] transition-colors font-tech-badge text-tech-badge uppercase tracking-widest flex items-center justify-center" href="#layanan">
                                Lihat layanan
                            </a>
                        </div>
                    </div>

                    {{-- Dua kartu produk bertumpuk, isi berganti tiap 3 detik --}}
                    <div
                        class="lg:col-span-6 xl:col-span-6 flex justify-center lg:justify-end"
                        x-data="heroProductStack(@js($heroCards))"
                        @mouseenter="pause()"
                        @mouseleave="resume()">
                        <div class="home-hero__stack">
                            <template x-for="(slot, si) in [0, 1]" :key="'slot-'+si">
                                <div
                                    class="home-hero__card-wrap"
                                    :class="si === 0 ? 'home-hero__card-wrap--a' : 'home-hero__card-wrap--b'">
                                    <div
                                        class="home-hero__card-float relative"
                                        :class="si === 0 ? 'home-hero__card-float--a' : 'home-hero__card-float--b'">
                                        <span class="home-hero__card-glow" aria-hidden="true" x-show="si === 0"></span>
                                        <article
                                            class="home-hero__card home-hero__card-face relative rounded-2xl overflow-hidden p-4 sm:p-5 min-h-[280px] sm:min-h-[300px] flex flex-col"
                                            :class="si === 0 ? 'home-hero__card--a' : 'home-hero__card--b'">
                                            <template x-if="cardAt(si)">
                                                <div class="home-hero__swap flex flex-col flex-1" :class="leaving && 'is-out'">
                                                    <span class="font-tech-code text-[10px] uppercase tracking-[0.14em] text-[#ff2a4b] mb-4" x-text="cardAt(si).label || 'Paket'"></span>
                                                    <h2 class="font-headline-md text-[18px] sm:text-[20px] font-semibold text-white tracking-tight mb-2" x-text="cardAt(si).name"></h2>
                                                    <p class="font-body-sm text-[13px] text-[#b4b4ba] leading-relaxed mb-4 line-clamp-2" x-text="cardAt(si).description"></p>
                                                    <ul class="space-y-2 mb-5">
                                                        <template x-for="(feature, fi) in cardAt(si).features" :key="fi">
                                                            <li class="flex items-start gap-2 font-body-sm text-[12px] text-[#d4d4d8]">
                                                                <span class="material-symbols-outlined text-[#ff2a4b] text-[15px] leading-5 mt-0.5">check_circle</span>
                                                                <span x-text="feature"></span>
                                                            </li>
                                                        </template>
                                                    </ul>
                                                    <div class="mt-auto flex items-end justify-between gap-2 pt-3 border-t border-white/10">
                                                        <div>
                                                            <div class="font-tech-code text-[9px] uppercase tracking-wider text-[#8b8b92] mb-0.5">Mulai dari</div>
                                                            <div class="font-headline-sm text-[16px] sm:text-[18px] font-semibold text-white" x-text="cardAt(si).price"></div>
                                                        </div>
                                                        <a class="inline-flex items-center gap-1 px-3 py-2 rounded-xl bg-white text-[#0e0e10] font-tech-badge text-[9px] uppercase tracking-widest hover:bg-[#ff2a4b] hover:text-white transition-colors" :href="cardAt(si).url">
                                                            Pilih
                                                            <span class="material-symbols-outlined text-[13px]">arrow_forward</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </template>
                                        </article>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <script>
                        function heroProductStack(items) {
                            return {
                                items: items || [],
                                index: 0,
                                leaving: false,
                                timer: null,
                                paused: false,
                                cardAt(slot) {
                                    if (!this.items.length) return null;
                                    return this.items[(this.index + slot) % this.items.length];
                                },
                                init() {
                                    if (this.items.length >= 2) this.start();
                                },
                                start() {
                                    this.stop();
                                    if (this.items.length < 2) return;
                                    this.timer = setInterval(() => {
                                        if (!this.paused) this.next();
                                    }, 3000);
                                },
                                stop() {
                                    if (this.timer) {
                                        clearInterval(this.timer);
                                        this.timer = null;
                                    }
                                },
                                pause() {
                                    this.paused = true;
                                },
                                resume() {
                                    this.paused = false;
                                },
                                next() {
                                    if (this.items.length < 2) return;
                                    this.leaving = true;
                                    setTimeout(() => {
                                        this.index = (this.index + 1) % this.items.length;
                                        this.leaving = false;
                                    }, 280);
                                },
                                destroy() {
                                    this.stop();
                                },
                            };
                        }
                    </script>
                </div>
            </div>
        </section>

        {{-- CARA KERJA --}}
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-xl pb-space-xl">
            @include('partials.section-head', ['index' => '01', 'title' => 'Cara kami bekerja', 'meta' => 'Dari kebutuhan sampai rilis'])
            <div class="divide-y divide-[#201f21]">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-4 font-tech-code text-body-sm text-[#a1a1aa]">Tim &amp; arsitektur</div>
                    <div class="lg:col-span-8">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-space-xs">Orang yang tepat sejak awal</h3>
                        <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed max-w-2xl">Developer, desainer, dan analis yang sudah menangani proyek lintas sektor: retail, pendidikan, kesehatan, sampai pemerintahan.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-4 font-tech-code text-body-sm text-[#ff2a4b]">Progres mingguan</div>
                    <div class="lg:col-span-8">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-space-xs">Anda tahu posisi proyek setiap saat</h3>
                        <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed max-w-2xl">Pengerjaan berjalan per sprint dengan laporan berkala dan versi uji yang bisa diakses—bukan kabar baik di akhir saja.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-4 font-tech-code text-body-sm text-[#a1a1aa]">Setelah rilis</div>
                    <div class="lg:col-span-8">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-space-xs">Kami tetap ada setelah peluncuran</h3>
                        <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed max-w-2xl">Perbaikan, penyesuaian, dan pengembangan lanjutan dikerjakan tim yang sama yang membangun sistemnya.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- LAYANAN --}}
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl" id="layanan">
            @include('partials.section-head', ['index' => '02', 'title' => 'Layanan & estimasi', 'link' => route('produk'), 'linkLabel' => 'Detail paket'])
            @include('partials.produk-cards', ['products' => $products])
        </section>

        {{-- DOKUMENTASI --}}
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '03', 'title' => 'Dokumentasi kerja', 'link' => route('galeri'), 'linkLabel' => 'Semua dokumentasi'])
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-md">
                @foreach ($galleryItems as $item)
                <figure>
                    <div class="overflow-hidden border border-[#26262a] bg-[#131315] aspect-[16/10]">
                        <img alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700 ease-out hover:scale-[1.03]" src="{{ $item->imageSrc() }}" />
                    </div>
                    <figcaption class="pt-space-sm font-body-sm text-body-sm text-[#a1a1aa]">{{ $item->title }}</figcaption>
                </figure>
                @endforeach
            </div>
        </section>

        {{-- ARTIKEL --}}
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '04', 'title' => 'Catatan terbaru', 'link' => route('artikel'), 'linkLabel' => 'Semua artikel'])
            <div class="divide-y divide-[#201f21]">
                @foreach ($articles as $article)
                <a class="group grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline" href="{{ route('artikel.show', $article) }}">
                    <span class="lg:col-span-2 font-tech-code text-body-sm text-[#a1a1aa]">{{ $article->formattedDate() }}</span>
                    <span class="lg:col-span-7 font-headline-sm text-headline-sm text-white group-hover:text-[#ff2a4b] transition-colors">{{ $article->title }}</span>
                    <span class="lg:col-span-3 font-tech-code text-body-sm text-[#a1a1aa] lg:text-right">{{ $article->metaLabel() }}</span>
                </a>
                @endforeach
            </div>
        </section>

        @include('partials.cta')
    </div>
</main>
@endsection