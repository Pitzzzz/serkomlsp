@extends('layouts.app')

@section('title', 'Produk & Layanan — PT Solusi Koneksi Anda')

@section('content')
<main class="w-full bg-[#0e0e10] min-h-screen">
    <div class="flex flex-col w-full text-on-surface overflow-hidden">
        @include('partials.page-header', [
        'index' => '03',
        'eyebrow' => 'Produk & layanan',
        'title' => 'Solusi yang bisa Anda mulai hari ini',
        'description' => 'Tiga jenis pekerjaan yang paling sering kami tangani. Semua paket mencakup konsultasi awal, desain, pengembangan, dan serah terima penuh ke tim Anda.',
        ])
        <!-- PAKET -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-xl pb-space-xl">
            @include('partials.section-head', ['index' => '01', 'title' => 'Paket & estimasi', 'meta' => 'Estimasi awal'])
            @include('partials.produk-cards')
            <p class="font-body-sm text-body-sm text-[#a1a1aa] mt-space-lg max-w-2xl">Harga di atas adalah estimasi awal. Nilai akhir menyesuaikan kompleksitas dan jumlah fitur yang disepakati bersama.</p>
        </section>
        <!-- LAYANAN PENDUKUNG -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '02', 'title' => 'Layanan pendukung', 'meta' => 'Ditambahkan sesuai kebutuhan'])
            <div class="divide-y divide-[#201f21] border-b border-[#201f21]">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-3 font-tech-code text-body-sm text-[#a1a1aa]">Perawatan &amp; dukungan</div>
                    <div class="lg:col-span-5">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">Sistem tetap sehat setelah rilis</h3>
                        <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Pemantauan berkala, perbaikan bug, pembaruan keamanan, dan kanal bantuan prioritas.</p>
                    </div>
                    <div class="lg:col-span-4 font-tech-code text-body-sm text-[#a1a1aa] lg:text-right">Mulai Rp 1.500.000 / bulan</div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-3 font-tech-code text-body-sm text-[#a1a1aa]">Performa &amp; SEO</div>
                    <div class="lg:col-span-5">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">Lebih cepat dan mudah ditemukan</h3>
                        <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Audit kecepatan, perbaikan struktur data, dan penyiapan halaman untuk mesin pencari.</p>
                    </div>
                    <div class="lg:col-span-4 font-tech-code text-body-sm text-[#a1a1aa] lg:text-right">Mulai Rp 2.500.000 / sekali kerja</div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-3 font-tech-code text-body-sm text-[#a1a1aa]">Integrasi &amp; migrasi</div>
                    <div class="lg:col-span-5">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">Menyambung sistem dan memindahkan data</h3>
                        <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Menghubungkan layanan pihak ketiga atau memindahkan data lama tanpa kehilangan riwayat.</p>
                    </div>
                    <div class="lg:col-span-4 font-tech-code text-body-sm text-[#a1a1aa] lg:text-right">Mulai Rp 3.000.000 / sesuai kebutuhan</div>
                </div>
            </div>
        </section>
        <!-- PROSES KERJA -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '03', 'title' => 'Empat tahap, satu alur'])
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-lg">
                <div class="border-t border-[#ff2a4b] pt-space-md">
                    <div class="font-tech-code text-body-sm text-[#ff2a4b]">Tahap 01</div>
                    <h3 class="font-headline-sm text-headline-sm text-white mt-1 mb-space-xs">Diskusi kebutuhan</h3>
                    <p class="font-body-sm text-body-sm text-[#a1a1aa] leading-relaxed">Memetakan proses bisnis Anda, lalu menyusun daftar fitur dan prioritasnya.</p>
                </div>
                <div class="border-t border-[#201f21] pt-space-md">
                    <div class="font-tech-code text-body-sm text-[#a1a1aa]">Tahap 02</div>
                    <h3 class="font-headline-sm text-headline-sm text-white mt-1 mb-space-xs">Desain &amp; prototipe</h3>
                    <p class="font-body-sm text-body-sm text-[#a1a1aa] leading-relaxed">Alur layar dibuat lebih dulu agar bisa Anda tinjau sebelum masuk ke kode.</p>
                </div>
                <div class="border-t border-[#201f21] pt-space-md">
                    <div class="font-tech-code text-body-sm text-[#a1a1aa]">Tahap 03</div>
                    <h3 class="font-headline-sm text-headline-sm text-white mt-1 mb-space-xs">Pengembangan</h3>
                    <p class="font-body-sm text-body-sm text-[#a1a1aa] leading-relaxed">Pengerjaan berjalan per sprint dengan laporan progres dan versi uji.</p>
                </div>
                <div class="border-t border-[#201f21] pt-space-md">
                    <div class="font-tech-code text-body-sm text-[#a1a1aa]">Tahap 04</div>
                    <h3 class="font-headline-sm text-headline-sm text-white mt-1 mb-space-xs">Peluncuran &amp; perawatan</h3>
                    <p class="font-body-sm text-body-sm text-[#a1a1aa] leading-relaxed">Setelah rilis, akses penuh diserahkan dan kami tetap tersedia untuk lanjutan.</p>
                </div>
            </div>
        </section>
        <!-- FAQ -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '04', 'title' => 'Hal yang sering ditanyakan'])
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
                <div class="lg:col-span-4">
                    <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Jika pertanyaan Anda belum terjawab, sampaikan langsung ke tim kami melalui halaman kontak.</p>
                </div>
                <div class="lg:col-span-8 flex flex-col">
                    <details class="group border-b border-[#201f21]">
                        <summary class="flex items-center justify-between gap-space-md py-space-md cursor-pointer list-none [&amp;::-webkit-details-marker]:hidden">
                            <span class="font-body-lg text-body-md font-medium text-white">Berapa lama waktu pengerjaan satu proyek?</span>
                            <span class="material-symbols-outlined text-[#a1a1aa] group-open:text-[#ff2a4b] text-[20px] transition-transform group-open:rotate-45">add</span>
                        </summary>
                        <p class="pb-space-md font-body-md text-body-md text-[#a1a1aa] leading-relaxed max-w-2xl">Website profil perusahaan umumnya 3–5 minggu. Aplikasi mobile dan sistem informasi berkisar 2–4 bulan, tergantung jumlah modul dan kecepatan umpan balik dari tim Anda.</p>
                    </details>
                    <details class="group border-b border-[#201f21]">
                        <summary class="flex items-center justify-between gap-space-md py-space-md cursor-pointer list-none [&amp;::-webkit-details-marker]:hidden">
                            <span class="font-body-lg text-body-md font-medium text-white">Apakah saya mendapatkan source code-nya?</span>
                            <span class="material-symbols-outlined text-[#a1a1aa] group-open:text-[#ff2a4b] text-[20px] transition-transform group-open:rotate-45">add</span>
                        </summary>
                        <p class="pb-space-md font-body-md text-body-md text-[#a1a1aa] leading-relaxed max-w-2xl">Ya. Setelah proyek selesai, repositori, kredensial server, dan dokumentasi diserahkan sepenuhnya kepada Anda tanpa biaya tambahan.</p>
                    </details>
                    <details class="group border-b border-[#201f21]">
                        <summary class="flex items-center justify-between gap-space-md py-space-md cursor-pointer list-none [&amp;::-webkit-details-marker]:hidden">
                            <span class="font-body-lg text-body-md font-medium text-white">Bagaimana skema pembayarannya?</span>
                            <span class="material-symbols-outlined text-[#a1a1aa] group-open:text-[#ff2a4b] text-[20px] transition-transform group-open:rotate-45">add</span>
                        </summary>
                        <p class="pb-space-md font-body-md text-body-md text-[#a1a1aa] leading-relaxed max-w-2xl">Pembayaran dibagi ke beberapa termin yang mengikuti tahapan proyek, sehingga tidak ada pembayaran penuh di awal.</p>
                    </details>
                    <details class="group border-b border-[#201f21]">
                        <summary class="flex items-center justify-between gap-space-md py-space-md cursor-pointer list-none [&amp;::-webkit-details-marker]:hidden">
                            <span class="font-body-lg text-body-md font-medium text-white">Bisakah menambah fitur setelah sistem berjalan?</span>
                            <span class="material-symbols-outlined text-[#a1a1aa] group-open:text-[#ff2a4b] text-[20px] transition-transform group-open:rotate-45">add</span>
                        </summary>
                        <p class="pb-space-md font-body-md text-body-md text-[#a1a1aa] leading-relaxed max-w-2xl">Bisa. Arsitektur kami dibuat modular supaya penambahan modul baru tidak mengganggu fitur yang sudah dipakai.</p>
                    </details>
                </div>
            </div>
        </section>
        @include('partials.cta')
    </div>
</main>
@endsection