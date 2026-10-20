@extends('layouts.app')

@section('title', 'Kontak — '.$contact['company_name'])

@section('content')
<main class="w-full bg-[#0e0e10] min-h-screen">
    <div class="flex flex-col w-full text-on-surface overflow-hidden">
        @include('partials.page-header', [
        'index' => '06',
        'eyebrow' => 'Kontak',
        'title' => 'Mari bicarakan kebutuhan Anda',
        'description' => 'Sampaikan pertanyaan, permintaan penawaran, atau rencana proyek Anda. Kami membalas pada hari kerja, Senin sampai Jumat.',
        ])

        @if (session('success'))
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-lg">
            <div class="border border-[#ff2a4b]/40 bg-[#ff2a4b]/10 px-space-md py-space-md font-body-md text-body-md text-white">
                {{ session('success') }}
            </div>
        </section>
        @endif

        @if ($errors->any())
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-lg">
            <div class="border border-red-500/40 bg-red-500/10 px-space-md py-space-md font-body-md text-body-md text-white">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
        @endif

        <!-- KANAL KONTAK -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pt-space-xl pb-space-xl">
            @include('partials.section-head', ['index' => '01', 'title' => 'Kanal kontak'])
            <div class="divide-y divide-[#201f21] border-b border-[#201f21]">
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-sm py-space-md items-baseline">
                    <span class="sm:col-span-3 font-tech-code text-body-sm text-[#a1a1aa]">Email</span>
                    <a class="sm:col-span-9 font-body-md text-body-md text-white hover:text-[#ff2a4b] transition-colors" href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-sm py-space-md items-baseline">
                    <span class="sm:col-span-3 font-tech-code text-body-sm text-[#a1a1aa]">Telepon</span>
                    <a class="sm:col-span-9 font-body-md text-body-md text-white hover:text-[#ff2a4b] transition-colors" href="tel:{{ $contact['phone_href'] }}">{{ $contact['phone'] }}</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-sm py-space-md items-baseline">
                    <span class="sm:col-span-3 font-tech-code text-body-sm text-[#a1a1aa]">Alamat</span>
                    <span class="sm:col-span-9 font-body-md text-body-md text-white">{{ $contact['address'] }}</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-sm py-space-md items-baseline">
                    <span class="sm:col-span-3 font-tech-code text-body-sm text-[#a1a1aa]">Jam kerja</span>
                    <span class="sm:col-span-9 font-body-md text-body-md text-white">{{ $contact['working_hours'] }}</span>
                </div>
            </div>
        </section>
        <!-- FORM & KANTOR -->
        <section class="w-full max-w-7xl mx-auto px-margin-mobile lg:px-margin pb-space-xl">
            @include('partials.section-head', ['index' => '02', 'title' => 'Kirim pesan', 'meta' => 'Respons rata-rata di bawah 1 hari kerja'])
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl lg:gap-16 items-start">
                <div class="lg:col-span-7">
                    <form method="POST" action="{{ route('kontak.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-x-space-lg gap-y-space-md">
                        @csrf
                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="nama">Nama</label>
                            <input class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap" type="text" required />
                        </div>
                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="email">Email</label>
                            <input class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="email" name="email" value="{{ old('email') }}" placeholder="nama@perusahaan.com" type="email" required />
                        </div>
                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="telepon">Telepon</label>
                            <input class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="08xx xxxx xxxx" type="tel" />
                        </div>
                        <div class="flex flex-col">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="perusahaan">Perusahaan</label>
                            <input class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="perusahaan" name="perusahaan" value="{{ old('perusahaan') }}" placeholder="Nama instansi atau usaha" type="text" />
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="topik">Topik</label>
                            <select class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors" id="topik" name="topik" required>
                                @foreach (['Permintaan penawaran', 'Pertanyaan teknis', 'Perawatan sistem berjalan', 'Kerja sama lainnya'] as $topik)
                                <option class="bg-[#131315]" value="{{ $topik }}" @selected(old('topik')===$topik)>{{ $topik }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label class="font-tech-code text-body-sm text-[#a1a1aa] mb-1" for="pesan">Pesan</label>
                            <textarea class="w-full bg-transparent border-0 border-b border-[#26262a] rounded-none px-0 py-3 text-white placeholder:text-[#52525b] focus:border-[#ff2a4b] focus:ring-0 outline-none font-body-md text-body-md transition-colors resize-none" id="pesan" name="pesan" placeholder="Ceritakan kebutuhan atau kendala yang sedang Anda hadapi" rows="4" required>{{ old('pesan') }}</textarea>
                        </div>
                        <div class="md:col-span-2 pt-space-sm">
                            <button class="w-full md:w-auto px-space-xl py-4 rounded bg-[#ff2a4b] text-white font-tech-badge text-tech-badge uppercase tracking-widest hover:bg-[#d6012e] transition-colors inline-flex items-center justify-center gap-3" type="submit">
                                <span>Kirim pesan</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="lg:col-span-5">
                    <figure>
                        <div class="rounded overflow-hidden border border-[#26262a] bg-[#131315] aspect-[4/3]">
                            <img alt="Kantor {{ $contact['company_name'] }}" class="w-full h-full object-cover object-center" src="{{ $contact['office_image'] }}" />
                        </div>
                        <figcaption class="flex items-baseline justify-between pt-space-sm font-tech-code text-xs">
                            <span class="text-[#a1a1aa]">Kantor kami</span>
                            <span class="text-[#ff2a4b]">{{ $contact['office_coords'] }}</span>
                        </figcaption>
                    </figure>
                    <div class="divide-y divide-[#201f21] border-b border-[#201f21] mt-space-lg">
                        <div class="py-space-md">
                            <div class="font-tech-code text-body-sm text-[#a1a1aa] mb-1">Dukungan klien</div>
                            <p class="font-body-md text-body-md text-white">{{ $contact['support_note'] }}</p>
                        </div>
                        <div class="py-space-md">
                            <div class="font-tech-code text-body-sm text-[#a1a1aa] mb-1">Legalitas</div>
                            <p class="font-body-md text-body-md text-white">{{ $contact['legal_note'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('partials.cta')
    </div>
</main>
@endsection