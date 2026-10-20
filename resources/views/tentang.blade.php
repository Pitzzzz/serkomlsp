@extends('layouts.app')

@section('title', 'Tentang — PT Solusi Koneksi Anda')

@section('content')
<main class="w-full bg-[#0e0e10] min-h-screen">
    <div class="flex flex-col w-full text-on-surface overflow-hidden">
        @include('partials.page-header', [
        'index' => '02',
        'eyebrow' => 'Tentang kami',
        'title' => 'Membangun software yang benar-benar dipakai',
        'description' => 'PT Solusi Koneksi Anda adalah software house di Bogor yang berdiri sejak 2018 dan berfokus pada website, aplikasi mobile, serta sistem informasi untuk perusahaan di Indonesia.',
        ])
        <!-- PROFIL -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-xl pb-space-xl">
            @include('partials.section-head', ['index' => '01', 'title' => 'Profil singkat', 'meta' => 'Bogor, Jawa Barat'])
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl lg:gap-16 items-start">
                <div class="lg:col-span-6">
                    <div class="space-y-space-md font-body-md text-body-md text-[#a1a1aa] leading-relaxed">
                        <p>Kami memulai dari proyek website sederhana untuk usaha kecil di Bogor. Seiring waktu, lingkup pekerjaan berkembang ke aplikasi mobile dan sistem informasi internal yang menangani data operasional harian klien.</p>
                        <p>Sampai sekarang cara kerjanya tetap sama: memahami proses bisnis lebih dulu, baru menulis kode. Setiap keputusan teknis harus bisa dijelaskan dalam bahasa bisnis.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-space-lg mt-space-xl pt-space-lg border-t border-[#201f21]">
                        <div>
                            <div class="font-headline-lg text-headline-lg text-white font-bold">120+</div>
                            <div class="font-tech-code text-body-sm text-[#a1a1aa] mt-1">Proyek diselesaikan</div>
                        </div>
                        <div>
                            <div class="font-headline-lg text-headline-lg text-white font-bold">60+</div>
                            <div class="font-tech-code text-body-sm text-[#a1a1aa] mt-1">Klien aktif &amp; alumni</div>
                        </div>
                    </div>
                </div>
                <figure class="lg:col-span-6">
                    <div class="rounded overflow-hidden border border-[#26262a] bg-[#131315] aspect-[4/3]">
                        <img alt="Ruang kerja PT Solusi Koneksi Anda" class="w-full h-full object-cover object-center" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDDib5kXsC4Ux2K6XHKqy5FPKnZpHsmKzTkmbmv4cH4hzjefDjWzeXfZxvuah9HxRIrxixqOmE2nN1lZFTJNboVLDwPxPxDa9Ay9wFr7PUMsVvsxke0iQkO4dTQ4o-oPA1TonF6apu3WoX8nzsPetB0TX9h_vNCPbssth_5Qea-rNjc8Fnzbyr5NFj-MGUcHaAQw5Xk9xum_Nc3IWdTnupzZPherXwoD9Nn1513Jv4h_q6HqIbZ3tRqPw" />
                    </div>
                    <figcaption class="flex items-baseline justify-between pt-space-sm font-tech-code text-xs">
                        <span class="text-[#a1a1aa]">Kantor kami</span>
                        <span class="text-[#ff2a4b]">Bogor, Jawa Barat</span>
                    </figcaption>
                </figure>
            </div>
        </section>
        <!-- VISI & MISI -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '02', 'title' => 'Visi & misi'])
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-xl lg:gap-16">
                <div>
                    <div class="font-tech-code text-body-sm text-[#a1a1aa] mb-space-sm">Visi</div>
                    <h3 class="font-headline-md text-headline-md text-white mb-space-md max-w-md">Teknologi yang bisa diandalkan jangka panjang</h3>
                    <p class="font-body-md text-body-md text-[#a1a1aa] leading-relaxed max-w-lg">Menjadi mitra teknologi yang dipilih karena kejelasan kerja dan hasil yang bertahan lama, bukan karena janji yang terdengar bagus.</p>
                </div>
                <div>
                    <div class="font-tech-code text-body-sm text-[#a1a1aa] mb-space-sm">Misi</div>
                    <h3 class="font-headline-md text-headline-md text-white mb-space-md max-w-md">Membuat proses pengembangan jadi transparan</h3>
                    <ul class="space-y-space-sm font-body-md text-body-md text-[#a1a1aa] max-w-lg">
                        <li class="flex gap-2"><span class="material-symbols-outlined text-[#ff2a4b] text-[16px] leading-6">check</span><span>Ruang lingkup dan estimasi disusun sebelum proyek dimulai.</span></li>
                        <li class="flex gap-2"><span class="material-symbols-outlined text-[#ff2a4b] text-[16px] leading-6">check</span><span>Progres dilaporkan berkala, bukan hanya di akhir.</span></li>
                        <li class="flex gap-2"><span class="material-symbols-outlined text-[#ff2a4b] text-[16px] leading-6">check</span><span>Kode dan dokumentasi diserahkan agar bisa dilanjutkan siapa pun.</span></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- PRINSIP KERJA -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '03', 'title' => 'Tiga hal yang tidak kami tawar'])
            <div class="divide-y divide-[#201f21] border-b border-[#201f21]">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-3 font-tech-code text-body-sm text-[#ff2a4b]">01 — Lingkup</div>
                    <div class="lg:col-span-4 font-headline-sm text-headline-sm text-white">Kejelasan sejak awal</div>
                    <p class="lg:col-span-5 font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Fitur, waktu, dan biaya disepakati tertulis sebelum baris kode pertama dibuat.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-3 font-tech-code text-body-sm text-[#ff2a4b]">02 — Kode</div>
                    <div class="lg:col-span-4 font-headline-sm text-headline-sm text-white">Kode yang bisa dibaca</div>
                    <p class="lg:col-span-5 font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Ditulis dengan konvensi umum agar mudah dirawat, termasuk oleh tim internal Anda.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-3 font-tech-code text-body-sm text-[#ff2a4b]">03 — Serah terima</div>
                    <div class="lg:col-span-4 font-headline-sm text-headline-sm text-white">Tidak ada ketergantungan</div>
                    <p class="lg:col-span-5 font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Akses repositori, server, dan dokumen diserahkan penuh ke klien.</p>
                </div>
            </div>
        </section>
        <!-- PERJALANAN -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '04', 'title' => 'Delapan tahun, satu arah'])
            <div class="divide-y divide-[#201f21] border-b border-[#201f21]">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <span class="lg:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">2018</span>
                    <div class="lg:col-span-10">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">Berdiri di Bogor</h3>
                        <p class="font-body-sm text-body-sm text-[#a1a1aa] max-w-2xl">Dimulai sebagai tim kecil yang mengerjakan website profil perusahaan dan toko online.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <span class="lg:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">2020</span>
                    <div class="lg:col-span-10">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">Masuk ke aplikasi mobile</h3>
                        <p class="font-body-sm text-body-sm text-[#a1a1aa] max-w-2xl">Mengerjakan aplikasi Android dan iOS pertama, termasuk integrasi pembayaran.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <span class="lg:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">2022</span>
                    <div class="lg:col-span-10">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">Sistem informasi kustom</h3>
                        <p class="font-body-sm text-body-sm text-[#a1a1aa] max-w-2xl">Mulai menangani ERP dan dashboard internal untuk klien di sektor distribusi.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <span class="lg:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">2023</span>
                    <div class="lg:col-span-10">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">Tim tumbuh jadi 25 orang</h3>
                        <p class="font-body-sm text-body-sm text-[#a1a1aa] max-w-2xl">Struktur kerja dibagi menjadi tim produk, engineering, dan dukungan klien.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <span class="lg:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">2024</span>
                    <div class="lg:col-span-10">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">Standar keamanan internal</h3>
                        <p class="font-body-sm text-body-sm text-[#a1a1aa] max-w-2xl">Audit akses dan pengujian keamanan menjadi bagian wajib sebelum peluncuran.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <span class="lg:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">2026</span>
                    <div class="lg:col-span-10">
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">120 proyek tercatat</h3>
                        <p class="font-body-sm text-body-sm text-[#a1a1aa] max-w-2xl">Dengan lebih dari 60 klien dari sektor retail, pendidikan, kesehatan, dan pemerintahan.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- TIM -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '05', 'title' => 'Orang yang bertanggung jawab atas pekerjaan Anda'])
            <div class="divide-y divide-[#201f21] border-b border-[#201f21]">
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-sm py-space-lg items-center">
                    <span class="sm:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">RS</span>
                    <span class="sm:col-span-5 font-headline-sm text-headline-sm text-white">Rangga Setiawan</span>
                    <span class="sm:col-span-5 font-body-sm text-body-sm text-[#a1a1aa] sm:text-right">Founder &amp; Principal Engineer</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-sm py-space-lg items-center">
                    <span class="sm:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">DP</span>
                    <span class="sm:col-span-5 font-headline-sm text-headline-sm text-white">Diah Puspita</span>
                    <span class="sm:col-span-5 font-body-sm text-body-sm text-[#a1a1aa] sm:text-right">Head of Product Design</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-sm py-space-lg items-center">
                    <span class="sm:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">AP</span>
                    <span class="sm:col-span-5 font-headline-sm text-headline-sm text-white">Arif Prasetyo</span>
                    <span class="sm:col-span-5 font-body-sm text-body-sm text-[#a1a1aa] sm:text-right">Lead Mobile Engineer</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-sm py-space-lg items-center">
                    <span class="sm:col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">NW</span>
                    <span class="sm:col-span-5 font-headline-sm text-headline-sm text-white">Nadia Wulandari</span>
                    <span class="sm:col-span-5 font-body-sm text-body-sm text-[#a1a1aa] sm:text-right">Client Success Lead</span>
                </div>
            </div>
        </section>
        @include('partials.cta')
    </div>
</main>
@endsection