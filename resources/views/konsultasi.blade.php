@extends('layouts.app')

@section('title', 'Konsultasi - PT Solusi Koneksi Anda')

@section('content')
<main class="w-full bg-[#0e0e10] min-h-screen">
    <div class="flex flex-col w-full text-on-surface overflow-hidden">
        @include('partials.page-header', [
        'index' => '07',
        'eyebrow' => 'Konsultasi',
        'title' => 'Ceritakan proyek yang ingin Anda bangun',
        'description' => 'Isi formulir berikut dan tim kami akan menghubungi Anda untuk sesi konsultasi awal tanpa biaya. Tidak ada kewajiban melanjutkan ke tahap pengembangan.',
        ])

        @if (session('success'))
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-lg">
            <div class="border border-[#ff2a4b]/40 bg-[#ff2a4b]/10 px-space-md py-space-md font-body-md text-body-md text-white">
                {{ session('success') }}
            </div>
        </section>
        @endif

        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-xl pb-space-xl">
            @include('partials.section-head', ['index' => '01', 'title' => 'Yang Anda dapatkan', 'meta' => 'Tanpa biaya'])
            <div class="divide-y divide-[#201f21] border-b border-[#201f21]">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-3 font-tech-code text-body-sm text-[#ff2a4b]">01 — Diskusi</div>
                    <div class="lg:col-span-4 font-headline-sm text-headline-sm text-white">Sesi 30 menit</div>
                    <p class="lg:col-span-5 font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Kami mendengar proses bisnis Anda lebih dulu, lalu memetakan fitur yang benar-benar dibutuhkan.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-3 font-tech-code text-body-sm text-[#ff2a4b]">02 — Estimasi</div>
                    <div class="lg:col-span-4 font-headline-sm text-headline-sm text-white">Perkiraan biaya &amp; waktu</div>
                    <p class="lg:col-span-5 font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Disampaikan dalam bentuk yang mudah dibaca, bukan istilah teknis yang membingungkan.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-sm lg:gap-space-lg py-space-lg items-baseline">
                    <div class="lg:col-span-3 font-tech-code text-body-sm text-[#ff2a4b]">03 — Rekomendasi</div>
                    <div class="lg:col-span-4 font-headline-sm text-headline-sm text-white">Pendekatan yang sesuai</div>
                    <p class="lg:col-span-5 font-body-md text-body-md text-[#a1a1aa] leading-relaxed">Termasuk bila menurut kami proyeknya belum perlu dijalankan sekarang.</p>
                </div>
            </div>
        </section>

        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl"
            x-data="consultationForm(@js([
        'productId' => $selectedProduct?->id,
        'layanan' => $selectedProduct?->name ?? old('layanan', ''),
        'anggaran' => $selectedProduct?->budget_range ?? old('anggaran', ''),
        'kebutuhan' => old('kebutuhan', $selectedProduct ? 'Saya tertarik dengan paket '.$selectedProduct->name.'. ' : ''),
        'products' => $products->map(fn ($p) => [
            'id' => $p->id,
            'name' => $p->name,
            'budget_range' => $p->budget_range,
        ])->values(),
    ]))">
            @include('partials.section-head', ['index' => '02', 'title' => 'Data proyek Anda'])

            @if ($selectedProduct)
            <div class="mb-space-lg border border-[#201f21] px-space-md py-space-md flex flex-col sm:flex-row sm:items-center sm:justify-between gap-space-sm">
                <div>
                    <div class="font-tech-code text-xs text-[#ff2a4b] uppercase tracking-wider">Paket dipilih</div>
                    <div class="font-headline-sm text-headline-sm text-white">{{ $selectedProduct->name }}</div>
                    <div class="font-body-sm text-body-sm text-[#a1a1aa] mt-1">Estimasi mulai {{ $selectedProduct->formattedPrice() }} · {{ $selectedProduct->budget_range }}</div>
                </div>
                <a class="font-tech-code text-body-sm text-[#a1a1aa] hover:text-white transition-colors" href="{{ route('konsultasi') }}">Ganti paket</a>
            </div>
            @endif

            @if ($errors->any())
            <div class="mb-space-lg border border-red-900/60 bg-red-950/40 px-space-md py-space-md">
                <ul class="space-y-1 font-body-sm text-body-sm text-[#ffb4ab]">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl lg:gap-16 items-start">
                <div class="lg:col-span-7">
                    <form class="grid grid-cols-1 md:grid-cols-2 gap-x-space-lg gap-y-space-md" method="POST" action="{{ route('konsultasi.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" :value="productId ?? ''">

                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="nama">Nama</label>
                            <input class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="nama" name="nama" placeholder="Nama lengkap" type="text" value="{{ old('nama') }}" required />
                        </div>
                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="perusahaan">Perusahaan</label>
                            <input class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="perusahaan" name="perusahaan" placeholder="Nama instansi atau usaha" type="text" value="{{ old('perusahaan') }}" />
                        </div>
                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="email">Email</label>
                            <input class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="email" name="email" placeholder="nama@perusahaan.com" type="email" value="{{ old('email') }}" required />
                        </div>
                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="telepon">Telepon</label>
                            <input class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="telepon" name="telepon" placeholder="08xx xxxx xxxx" type="tel" value="{{ old('telepon') }}" required />
                        </div>
                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="layanan">Jenis layanan</label>
                            <select class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="layanan" name="layanan" x-model="layanan" @change="onLayananChange()" required>
                                <option class="bg-[#131315]" value="">Pilih layanan</option>
                                @foreach ($products as $product)
                                <option class="bg-[#131315]" value="{{ $product->name }}" data-id="{{ $product->id }}" data-budget="{{ $product->budget_range }}">{{ $product->name }}</option>
                                @endforeach
                                <option class="bg-[#131315]" value="Belum ditentukan">Belum ditentukan</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="anggaran">Perkiraan anggaran</label>
                            <select class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="anggaran" name="anggaran" x-model="anggaran" required>
                                <option class="bg-[#131315]" value="">Pilih rentang</option>
                                <option class="bg-[#131315]" value="Di bawah Rp 10 juta">Di bawah Rp 10 juta</option>
                                <option class="bg-[#131315]" value="Rp 10–25 juta">Rp 10–25 juta</option>
                                <option class="bg-[#131315]" value="Rp 25–50 juta">Rp 25–50 juta</option>
                                <option class="bg-[#131315]" value="Rp 50 juta+">Rp 50 juta+</option>
                                <option class="bg-[#131315]" value="Di atas Rp 50 juta">Di atas Rp 50 juta</option>
                            </select>
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="kebutuhan">Deskripsi kebutuhan</label>
                            <textarea class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors resize-none" id="kebutuhan" name="kebutuhan" x-model="kebutuhan" placeholder="Jelaskan masalah yang ingin diselesaikan, siapa penggunanya, dan target waktu bila ada" rows="4" required></textarea>
                        </div>
                        <div class="md:col-span-2 pt-space-sm">
                            <button class="w-full md:w-auto px-space-xl py-4 rounded bg-[#ff2a4b] text-white font-tech-badge text-tech-badge uppercase tracking-widest hover:bg-[#d6012e] transition-colors inline-flex items-center justify-center gap-3" type="submit">
                                <span>Ajukan konsultasi</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="lg:col-span-5">
                    <div class="font-tech-code text-body-sm text-[#a1a1aa] mb-space-lg">Setelah Anda mengirim</div>
                    <div class="divide-y divide-[#201f21] border-t border-b border-[#201f21]">
                        <div class="grid grid-cols-12 gap-space-md py-space-md items-baseline">
                            <span class="col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">01</span>
                            <div class="col-span-10">
                                <h3 class="font-headline-sm text-headline-sm text-white mb-1">Kami menghubungi Anda</h3>
                                <p class="font-body-sm text-body-sm text-[#a1a1aa] leading-relaxed">Melalui email atau telepon, maksimal 1 hari kerja setelah formulir masuk.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-space-md py-space-md items-baseline">
                            <span class="col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">02</span>
                            <div class="col-span-10">
                                <h3 class="font-headline-sm text-headline-sm text-white mb-1">Sesi konsultasi</h3>
                                <p class="font-body-sm text-body-sm text-[#a1a1aa] leading-relaxed">Dilakukan daring atau di kantor kami di Bogor, sesuai kenyamanan Anda.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-space-md py-space-md items-baseline">
                            <span class="col-span-2 font-tech-code text-body-sm text-[#ff2a4b]">03</span>
                            <div class="col-span-10">
                                <h3 class="font-headline-sm text-headline-sm text-white mb-1">Ringkasan &amp; penawaran</h3>
                                <p class="font-body-sm text-body-sm text-[#a1a1aa] leading-relaxed">Anda menerima dokumen ringkas berisi lingkup, estimasi, dan tahapan proyek.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-baseline justify-between pt-space-lg font-tech-code text-body-sm">
                        <span class="text-[#a1a1aa]">Jam kerja</span>
                        <span class="text-white">Senin–Jumat, 08.00–17.00 WIB</span>
                    </div>
                </div>
            </div>
        </section>
        @include('partials.cta')
    </div>
</main>

<script>
    function consultationForm(initial) {
        return {
            productId: initial.productId,
            layanan: initial.layanan,
            anggaran: initial.anggaran,
            kebutuhan: initial.kebutuhan,
            products: initial.products,
            onLayananChange() {
                const match = this.products.find((p) => p.name === this.layanan);
                if (match) {
                    this.productId = match.id;
                    this.anggaran = match.budget_range;
                } else {
                    this.productId = null;
                }
            },
        };
    }
</script>
@endsection