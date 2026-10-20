{{-- Header editorial halaman dalam. Parameter: $index, $eyebrow, $title, $description --}}
<section class="w-full bg-[#0e0e10] border-b border-[#201f21] relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,rgba(255,42,75,0.08),transparent_55%)]"></div>
    <div class="relative max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-28 lg:pt-32 pb-space-xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-md lg:gap-16 items-end">
            <div class="lg:col-span-7">
                <div class="font-tech-code text-body-sm text-[#a1a1aa] mb-space-md uppercase tracking-[0.12em]">{{ $index }} <span class="text-[#353437]">/</span> {{ $eyebrow }}</div>
                <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl text-white tracking-tight">{{ $title }}</h1>
            </div>
            <div class="lg:col-span-5">
                <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed">{{ $description }}</p>
            </div>
        </div>
    </div>
</section>