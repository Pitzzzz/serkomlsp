{{-- Judul section editorial. Parameter: $index, $title, $meta (opsional) atau $link + $linkLabel (opsional) --}}
<div class="border-t border-[#201f21] pt-space-lg mb-space-xl flex flex-col md:flex-row md:items-baseline md:justify-between gap-space-sm">
    <div class="flex items-baseline gap-space-md">
        <span class="font-tech-code text-body-sm text-[#ff2a4b]">{{ $index }}</span>
        <h2 class="font-headline-lg text-headline-md lg:text-headline-lg text-white tracking-tight">{{ $title }}</h2>
    </div>
    @if (isset($link))
    <a class="font-tech-code text-body-sm text-[#a1a1aa] hover:text-white transition-colors inline-flex items-center gap-1.5" href="{{ $link }}">
        <span>{{ $linkLabel }}</span>
        <span class="material-symbols-outlined text-[16px]">arrow_outward</span>
    </a>
    @elseif (isset($meta))
    <span class="font-tech-code text-body-sm text-[#a1a1aa]">{{ $meta }}</span>
    @endif
</div>