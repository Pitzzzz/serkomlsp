{{-- Expects $products collection --}}
<div class="divide-y divide-[#201f21] border-y border-[#201f21]">
    @foreach ($products as $product)
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-md lg:gap-space-lg py-space-lg items-start lg:items-center group transition-colors hover:bg-white/[0.015] -mx-margin-mobile px-margin-mobile lg:-mx-0 lg:px-0 rounded">
        <div class="lg:col-span-4">
            <div class="font-tech-code text-body-sm text-[#a1a1aa] mb-1">{{ $product->label }}</div>
            <h3 class="font-headline-md text-headline-md text-white mb-space-xs">{{ $product->name }}</h3>
            <p class="font-body-sm text-body-sm text-[#a1a1aa] leading-relaxed">{{ $product->description }}</p>
        </div>
        <ul class="lg:col-span-4 space-y-2 font-body-sm text-body-sm text-[#a1a1aa]">
            @foreach ($product->features as $feature)
            <li class="flex items-start gap-2"><span class="material-symbols-outlined text-[#ff2a4b] text-[16px] leading-6">check</span><span>{{ $feature }}</span></li>
            @endforeach
        </ul>
        <div class="lg:col-span-2">
            <div class="font-tech-code text-xs text-[#a1a1aa]">Mulai dari</div>
            <div class="font-headline-sm text-headline-sm text-white">{{ $product->formattedPrice() }}</div>
        </div>
        <div class="lg:col-span-2 lg:text-right">
            <a class="inline-flex items-center gap-2 font-tech-badge text-tech-badge uppercase tracking-wider text-white border-b border-[#2a2a2c] hover:border-[#ff2a4b] hover:text-[#ff2a4b] transition-colors pb-1" data-path="konsultasi" href="{{ $product->consultationUrl() }}">
                Pilih paket<span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
    </div>
    @endforeach
</div>