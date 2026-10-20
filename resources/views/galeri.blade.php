@extends('layouts.app')

@section('title', 'Galeri — PT Solusi Koneksi Anda')

@section('content')
<main class="w-full bg-[#0e0e10] min-h-screen" x-data="galleryLightbox(@js($items->map(fn ($item) => [
    'title' => $item->title,
    'category' => $item->category,
    'image_url' => $item->imageSrc(),
])->values()))">
    <div class="flex flex-col w-full text-on-surface overflow-hidden">
        @include('partials.page-header', [
        'index' => '04',
        'eyebrow' => 'Galeri',
        'title' => 'Rekam jejak pekerjaan kami',
        'description' => 'Sesi diskusi dengan klien, proses pengerjaan, ruang kerja, dan momen di balik proyek yang selesai.',
        ])

        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-xl pb-space-xl">
            @include('partials.section-head', ['index' => '01', 'title' => $items->count().' dokumentasi', 'meta' => 'Klik untuk memperbesar'])

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-md">
                @foreach ($items as $index => $item)
                <figure class="{{ $item->span }}">
                    <button
                        type="button"
                        class="group block w-full text-left"
                        @click="open({{ $index }})">
                        <div class="overflow-hidden border border-[#26262a] bg-[#131315] {{ $item->aspect }}">
                            <img alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-[1.03]" src="{{ $item->imageSrc() }}" />
                        </div>
                        <figcaption class="flex items-baseline justify-between pt-space-sm">
                            <span class="font-body-sm text-body-sm text-white group-hover:text-[#ff2a4b] transition-colors">{{ $item->title }}</span>
                            <span class="font-tech-code text-xs text-[#a1a1aa]">{{ $item->category }}</span>
                        </figcaption>
                    </button>
                </figure>
                @endforeach
            </div>
        </section>

        {{-- Lightbox --}}
        <div
            x-show="active !== null"
            x-cloak
            class="fixed inset-0 z-[80] flex items-center justify-center p-4 sm:p-8"
            role="dialog"
            aria-modal="true"
            @keydown.escape.window="close()"
            @keydown.arrow-left.window="prev()"
            @keydown.arrow-right.window="next()">
            <div class="absolute inset-0 bg-[#0e0e10]/92" @click="close()"></div>

            <div class="relative z-10 w-full max-w-5xl" @click.stop>
                <div class="flex items-center justify-between mb-space-md">
                    <div class="min-w-0">
                        <div class="font-tech-code text-xs text-[#ff2a4b] uppercase tracking-wider" x-text="current?.category"></div>
                        <div class="font-headline-sm text-headline-sm text-white truncate" x-text="current?.title"></div>
                    </div>
                    <button type="button" class="shrink-0 w-10 h-10 border border-[#2a2a2c] text-[#a1a1aa] hover:text-white hover:border-[#ff2a4b] transition-colors inline-flex items-center justify-center" @click="close()" aria-label="Tutup">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                </div>

                <div class="relative border border-[#26262a] bg-[#131315]">
                    <img :src="current?.image_url" :alt="current?.title" class="w-full max-h-[70vh] object-contain bg-black" />
                    <button type="button" class="absolute left-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-[#0e0e10]/80 border border-[#2a2a2c] text-white hover:border-[#ff2a4b] transition-colors inline-flex items-center justify-center" @click="prev()" aria-label="Sebelumnya">
                        <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                    </button>
                    <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-[#0e0e10]/80 border border-[#2a2a2c] text-white hover:border-[#ff2a4b] transition-colors inline-flex items-center justify-center" @click="next()" aria-label="Berikutnya">
                        <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                    </button>
                </div>

                <div class="mt-space-sm font-tech-code text-xs text-[#6b6b70] text-right">
                    <span x-text="(active + 1)"></span> / <span x-text="items.length"></span>
                </div>
            </div>
        </div>

        @include('partials.cta')
    </div>
</main>

<script>
    function galleryLightbox(items) {
        return {
            items,
            active: null,
            get current() {
                return this.active === null ? null : this.items[this.active];
            },
            open(index) {
                this.active = index;
                document.body.style.overflow = 'hidden';
            },
            close() {
                this.active = null;
                document.body.style.overflow = '';
            },
            prev() {
                if (this.active === null || !this.items.length) return;
                this.active = (this.active - 1 + this.items.length) % this.items.length;
            },
            next() {
                if (this.active === null || !this.items.length) return;
                this.active = (this.active + 1) % this.items.length;
            },
        };
    }
</script>
@endsection