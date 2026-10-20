<footer class="w-full bg-[#0a0a0c] border-t border-[#201f21] mt-space-xl">
    <div class="max-w-7xl mx-auto px-margin-mobile lg:px-margin">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg lg:gap-space-xl py-space-xl border-b border-[#201f21]">
            <!-- IDENTITAS -->
            <div class="lg:col-span-5">
                <div class="flex items-center gap-space-sm mb-space-md">
                    <img alt="PT Solusi Koneksi Anda" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida/AEtjO1U2BK6AancLmp4ijR2hH6rvuOps3gOQMIeKqRbFnC_8CezHmv8iZKGOHEdViT9_YhVcTxSnT5KLv4srrWVwW4rqTzzeIho1cdNWWkUyWm6Ob20GMnunflCpNExc7m37V_iLy_Q3OR2NxXhiBPeBIyxNqLolJs95wD4SyDMjMhaq-Yq_4ioxd-v6qsyGVIKNHxNOj3EBtgmEOIODyoOG_-qZoujXhKp8pnCa-TUhCqfWgkrMCe-vdcO5MXM" />
                    <span class="font-headline-sm text-headline-sm text-white tracking-tight">{{ $siteContact['company_name'] ?? 'PT Solusi Koneksi Anda' }}</span>
                </div>
                <p class="font-body-sm text-body-sm text-[#6b6b70] max-w-sm leading-relaxed">Software house di Bogor yang membangun website, aplikasi mobile, dan sistem informasi untuk perusahaan di Indonesia.</p>
            </div>
            <!-- NAVIGASI -->
            <div class="lg:col-span-4 lg:col-start-7">
                <div class="font-tech-code text-body-sm text-[#6b6b70] mb-space-md">Navigasi</div>
                <div class="grid grid-cols-2 gap-y-2.5 gap-x-space-lg">
                    <a class="font-body-sm text-body-sm text-[#a1a1aa] hover:text-white transition-colors" data-path="beranda" href="{{ url('/') }}">Beranda</a>
                    <a class="font-body-sm text-body-sm text-[#a1a1aa] hover:text-white transition-colors" data-path="tentang" href="{{ url('/tentang') }}">Tentang</a>
                    <a class="font-body-sm text-body-sm text-[#a1a1aa] hover:text-white transition-colors" data-path="galeri" href="{{ url('/galeri') }}">Galeri</a>
                    <a class="font-body-sm text-body-sm text-[#a1a1aa] hover:text-white transition-colors" data-path="artikel" href="{{ url('/artikel') }}">Artikel</a>
                    <a class="font-body-sm text-body-sm text-[#a1a1aa] hover:text-white transition-colors" data-path="produk" href="{{ url('/produk') }}">Produk</a>
                    <a class="font-body-sm text-body-sm text-[#a1a1aa] hover:text-white transition-colors" data-path="kontak" href="{{ url('/kontak') }}">Kontak</a>
                    <a class="font-body-sm text-body-sm text-[#a1a1aa] hover:text-white transition-colors" data-path="konsultasi" href="{{ url('/konsultasi') }}">Konsultasi</a>
                </div>
            </div>
            <!-- KONTAK -->
            <div class="lg:col-span-2">
                <div class="font-tech-code text-body-sm text-[#6b6b70] mb-space-md">Kontak</div>
                <ul class="space-y-2.5 font-body-sm text-body-sm text-[#a1a1aa]">
                    <li><a class="hover:text-white transition-colors" href="mailto:{{ $siteContact['email'] ?? 'info@solusikoneksianda.example' }}">{{ $siteContact['email'] ?? 'info@solusikoneksianda.example' }}</a></li>
                    <li><a class="hover:text-white transition-colors" href="tel:{{ $siteContact['phone_href'] ?? '02510000000' }}">{{ $siteContact['phone'] ?? '(0251) 000-0000' }}</a></li>
                    <li>{{ $siteContact['city'] ?? 'Bogor, Jawa Barat' }}</li>
                </ul>
            </div>
        </div>
        <!-- BAR BAWAH -->
        <div class="py-space-md flex flex-col sm:flex-row items-baseline justify-between gap-2 font-tech-code text-[11px] tracking-wider text-[#6b6b70]">
            <span>© {{ date('Y') }} {{ $siteContact['company_name'] ?? 'PT Solusi Koneksi Anda' }}. Hak cipta dilindungi.</span>
            <span>{{ $siteContact['office_coords'] ?? '6.59°S 106.79°E' }}</span>
        </div>
    </div>
</footer>