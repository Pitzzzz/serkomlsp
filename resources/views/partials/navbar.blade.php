{{-- Floating navbar: mengambang di atas konten --}}
<div class="fixed top-3 left-0 right-0 z-50 px-3 sm:px-margin-mobile lg:px-margin pointer-events-none">
    <header class="nav-float pointer-events-auto max-w-7xl mx-auto rounded-[999px] border border-white/10 bg-[#0e0e10]/70 backdrop-blur-xl shadow-[0_12px_40px_rgba(0,0,0,0.45)]">
        <div class="h-[4.25rem] flex items-center justify-between gap-space-md px-5 sm:px-6 lg:px-7">
            <a class="flex items-center gap-space-sm min-w-0" href="{{ url('/') }}">
                <img alt="PT Solusi Koneksi Anda" class="h-8 w-auto object-contain shrink-0" src="https://lh3.googleusercontent.com/aida/AEtjO1U2BK6AancLmp4ijR2hH6rvuOps3gOQMIeKqRbFnC_8CezHmv8iZKGOHEdViT9_YhVcTxSnT5KLv4srrWVwW4rqTzzeIho1cdNWWkUyWm6Ob20GMnunflCpNExc7m37V_iLy_Q3OR2NxXhiBPeBIyxNqLolJs95wD4SyDMjMhaq-Yq_4ioxd-v6qsyGVIKNHxNOj3EBtgmEOIODyoOG_-qZoujXhKp8pnCa-TUhCqfWgkrMCe-vdcO5MXM" />
                <span class="hidden md:inline-block font-headline-sm text-[15px] font-semibold text-white tracking-tight truncate">PT Solusi Koneksi Anda</span>
            </a>
            @php
            $navItems = [
            ['path' => 'beranda', 'label' => 'Beranda', 'url' => '/', 'match' => '/'],
            ['path' => 'tentang', 'label' => 'Tentang', 'url' => '/tentang', 'match' => 'tentang'],
            ['path' => 'galeri', 'label' => 'Galeri', 'url' => '/galeri', 'match' => 'galeri'],
            ['path' => 'artikel', 'label' => 'Artikel', 'url' => '/artikel', 'match' => 'artikel*'],
            ['path' => 'produk', 'label' => 'Produk', 'url' => '/produk', 'match' => 'produk'],
            ['path' => 'kontak', 'label' => 'Kontak', 'url' => '/kontak', 'match' => 'kontak'],
            ];
            @endphp
            <nav class="hidden lg:flex items-center gap-5">
                @foreach ($navItems as $item)
                @php $isActive = request()->is($item['match']); @endphp
                <a @if ($isActive) aria-current="page" @endif class="font-tech-code text-[12px] tracking-wide transition-colors {{ $isActive ? 'text-[#ff2a4b]' : 'text-[#9a9aa0] hover:text-white' }}" data-path="{{ $item['path'] }}" href="{{ url($item['url']) }}">{{ $item['label'] }}</a>
                @endforeach
            </nav>
            <a class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-[999px] bg-[#ff2a4b] text-white font-tech-badge text-tech-badge uppercase tracking-widest hover:bg-[#d6012e] transition-colors shrink-0 {{ request()->routeIs('konsultasi*') ? 'ring-1 ring-white/25' : '' }}" data-path="konsultasi" href="{{ route('konsultasi') }}">
                <span class="hidden sm:inline">Konsultasi</span>
                <span class="sm:hidden">Mulai</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
    </header>
</div>