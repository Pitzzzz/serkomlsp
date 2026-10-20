<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Consultation;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        SeederImages::publish();

        Consultation::query()->delete();
        ContactMessage::query()->delete();
        GalleryItem::query()->delete();
        Article::query()->delete();
        Product::query()->delete();

        $this->seedProducts();
        $this->seedArticles();
        $this->seedGallery();
        $this->seedContactMessages();
        $this->seedConsultations();
    }

    private function seedProducts(): void
    {
        $catalog = [
            ['Website Perusahaan', 'Website', 'Website profil atau katalog dengan pengelolaan konten mandiri.', ['Desain khusus sesuai brand', 'CMS untuk update mandiri', 'Optimasi mobile & SEO dasar'], 5000000, 'Di bawah Rp 10 juta'],
            ['Aplikasi Mobile', 'Aplikasi', 'Aplikasi Android dan iOS sesuai alur bisnis Anda.', ['Native atau Flutter', 'Notifikasi & autentikasi', 'Publikasi ke store'], 15000000, 'Rp 10–25 juta'],
            ['Sistem Informasi Kustom', 'Sistem', 'Sistem internal untuk mengelola data dan operasional harian.', ['ERP / CRM / dashboard', 'Hak akses per peran', 'Integrasi database'], 20000000, 'Rp 25–50 juta'],
            ['Landing Page Kampanye', 'Website', 'Halaman tunggal untuk kampanye produk atau event.', ['Copy & CTA terarah', 'Integrasi form lead', 'Tracking konversi'], 3500000, 'Di bawah Rp 10 juta'],
            ['Toko Online', 'Website', 'Katalog produk, keranjang, dan pembayaran online.', ['Manajemen produk', 'Gateway pembayaran', 'Laporan penjualan'], 12000000, 'Rp 10–25 juta'],
            ['Portal Berita', 'Website', 'Portal konten berita atau majalah digital.', ['Editor & kategori', 'Pencarian konten', 'AMP / kecepatan'], 18000000, 'Rp 10–25 juta'],
            ['CRM Penjualan', 'Sistem', 'Kelola prospek, pipeline, dan follow-up tim sales.', ['Pipeline visual', 'Reminder tugas', 'Laporan funnel'], 22000000, 'Rp 25–50 juta'],
            ['HRIS Kepegawaian', 'Sistem', 'Absensi, cuti, dan data karyawan terpusat.', ['Absensi digital', 'Pengajuan cuti', 'Slip gaji'], 25000000, 'Rp 25–50 juta'],
            ['Dashboard Analitik', 'Data', 'Visualisasi KPI operasional dalam satu layar.', ['Integrasi sumber data', 'Filter periode', 'Export laporan'], 16000000, 'Rp 10–25 juta'],
            ['API Integrasi', 'Backend', 'Menghubungkan sistem lama dengan layanan baru.', ['Dokumentasi API', 'Autentikasi token', 'Logging request'], 14000000, 'Rp 10–25 juta'],
            ['Chatbot Layanan', 'Aplikasi', 'Bot percakapan untuk FAQ dan triage tiket.', ['Integrasi WhatsApp/web', 'Intent training', 'Handover ke agen'], 11000000, 'Rp 10–25 juta'],
            ['Aplikasi Booking', 'Aplikasi', 'Reservasi jadwal layanan atau fasilitas.', ['Kalender slot', 'Notifikasi booking', 'Panel admin'], 13000000, 'Rp 10–25 juta'],
            ['Inventory Gudang', 'Sistem', 'Stok barang, mutasi, dan stok opname.', ['Barcode / QR', 'Mutasi antar gudang', 'Alert stok rendah'], 21000000, 'Rp 25–50 juta'],
            ['LMS Pelatihan', 'Sistem', 'Platform kursus internal untuk karyawan.', ['Modul & kuis', 'Progress belajar', 'Sertifikat'], 19000000, 'Rp 10–25 juta'],
            ['Website Sekolah', 'Website', 'Profil sekolah, berita, dan PPDB online.', ['Halaman PPDB', 'Galeri kegiatan', 'Berita sekolah'], 8000000, 'Di bawah Rp 10 juta'],
            ['Aplikasi Field Force', 'Aplikasi', 'Aplikasi petugas lapangan dengan GPS & laporan.', ['Check-in lokasi', 'Foto bukti', 'Sinkron offline'], 24000000, 'Rp 25–50 juta'],
            ['Helpdesk Tiket', 'Sistem', 'Antrian tiket dukungan pelanggan.', ['SLA & prioritas', 'Knowledge base', 'Laporan respons'], 17000000, 'Rp 10–25 juta'],
            ['Portal Vendor', 'Sistem', 'Kolaborasi dengan pemasok dan dokumen PO.', ['Upload dokumen', 'Status PO', 'Notifikasi status'], 23000000, 'Rp 25–50 juta'],
            ['Website Pariwisata', 'Website', 'Paket wisata, galeri destinasi, dan booking.', ['Katalog paket', 'Galeri destinasi', 'Form pemesanan'], 9000000, 'Di bawah Rp 10 juta'],
            ['POS Retail', 'Sistem', 'Kasir toko dengan laporan harian.', ['Transaksi cepat', 'Diskon & promo', 'Laporan omzet'], 15000000, 'Rp 10–25 juta'],
            ['Aplikasi Membership', 'Aplikasi', 'Kartu member digital, poin, dan reward.', ['Poin & tier', 'QR member', 'Push promo'], 12500000, 'Rp 10–25 juta'],
            ['Monitoring IoT', 'Data', 'Dashboard sensor dan alert perangkat.', ['Realtime chart', 'Threshold alert', 'Log historis'], 28000000, 'Rp 25–50 juta'],
            ['Website Klinik', 'Website', 'Profil klinik, layanan, dan janji temu online.', ['Jadwal dokter', 'Booking online', 'Artikel kesehatan'], 7500000, 'Di bawah Rp 10 juta'],
            ['Migrasi Legacy', 'Backend', 'Pindahkan data & sistem lama ke stack modern.', ['Audit data', 'ETL migrasi', 'Uji regresi'], 30000000, 'Rp 50 juta+'],
            ['Retainer Perawatan', 'Perawatan', 'Pemeliharaan berkala, update, dan dukungan prioritas.', ['Patch keamanan', 'Backup terjadwal', 'Kanal prioritas'], 2500000, 'Di bawah Rp 10 juta'],
        ];

        foreach ($catalog as $index => [$name, $labelType, $description, $features, $price, $budget]) {
            $order = $index + 1;

            Product::query()->create([
                'slug' => Str::slug($name),
                'name' => $name,
                'label' => str_pad((string) $order, 2, '0', STR_PAD_LEFT).' / '.$labelType,
                'description' => $description,
                'features' => $features,
                'price_from' => $price,
                'budget_range' => $budget,
                'is_highlighted' => in_array($order, [2, 5, 17], true),
                'highlight_note' => in_array($order, [2, 5, 17], true) ? 'rekomendasi' : null,
                'sort_order' => $order,
            ]);
        }
    }

    private function seedArticles(): void
    {
        $articles = [
            ['Mengenal siklus pengembangan software', 'Panduan', 'Dari analisis kebutuhan hingga perawatan, kenali tahapan yang dilalui sebuah aplikasi sebelum siap dipakai.'],
            ['Tips memilih vendor pembuat aplikasi', 'Panduan', 'Beberapa pertanyaan praktis sebelum menandatangani kontrak dengan software house.'],
            ['Pentingnya keamanan pada aplikasi web', 'Keamanan', 'Keamanan bukan fitur tambahan. Ini fondasi yang harus ada sejak hari pertama.'],
            ['Kapan bisnis perlu migrasi ke sistem informasi', 'Sistem', 'Spreadsheet masih bagus—sampai titik tertentu. Kenali sinyal sudah waktunya pindah.'],
            ['Memahami biaya tersembunyi proyek software', 'Manajemen', 'Harga di penawaran jarang mencakup seluruh biaya yang akan Anda keluarkan.'],
            ['Aplikasi native atau cross-platform?', 'Teknologi', 'Pilihan teknis yang berdampak langsung ke biaya, waktu, dan pengalaman pengguna.'],
            ['Menyiapkan data sebelum membangun dashboard', 'Data', 'Dashboard cantik tidak berguna jika sumber datanya berantakan.'],
            ['Cara menulis brief proyek yang jelas', 'Panduan', 'Brief yang rapi memangkas revisi dan mempercepat kickoff.'],
            ['Checklist UAT sebelum go-live', 'Manajemen', 'Daftar praktis agar rilis pertama tidak berubah menjadi kebakaran operasional.'],
            ['Peran dokumentasi teknis untuk tim bisnis', 'Panduan', 'Dokumentasi bukan hanya untuk developer—tim operasional juga membutuhkannya.'],
            ['Mengukur ROI investasi digital', 'Manajemen', 'Cara sederhana menautkan fitur aplikasi dengan metrik bisnis.'],
            ['Praktik autentikasi yang aman', 'Keamanan', 'Password hashing, MFA, dan sesi yang tidak mudah dibajak.'],
            ['Desain UX untuk aplikasi internal', 'Teknologi', 'Aplikasi karyawan harus cepat dipahami, bukan sekadar “berfungsi”.'],
            ['Membangun API yang mudah diintegrasikan', 'Teknologi', 'Konvensi penamaan, versi, dan error yang ramah konsumen API.'],
            ['Strategi backup dan disaster recovery', 'Keamanan', 'Rencana pemulihan yang bisa diuji, bukan hanya tertulis di proposal.'],
            ['Dari MVP ke produk mature', 'Sistem', 'Kapan menambah fitur, kapan menahan, dan bagaimana menjaga utang teknis.'],
            ['Menyusun backlog yang realistis', 'Manajemen', 'Prioritas fitur tanpa membuat sprint membengkak.'],
            ['Observability untuk aplikasi produksi', 'Data', 'Log, metrik, dan tracing agar masalah ketahuan sebelum pelanggan mengadu.'],
            ['Integrasi pembayaran di Indonesia', 'Teknologi', 'Gateway, settlement, dan hal yang sering terlewat di kontrak.'],
            ['Mengelola hak akses berbasis peran', 'Keamanan', 'RBAC yang jelas mengurangi risiko kebocoran data internal.'],
            ['Migrasi cloud tanpa downtime panjang', 'Sistem', 'Strategi cutover bertahap untuk sistem yang sudah dipakai harian.'],
            ['Konten website yang membantu konversi', 'Panduan', 'Struktur halaman yang membuat pengunjung paham dan bertindak.'],
            ['Memilih database untuk skala menengah', 'Data', 'Relasional, dokumen, atau hybrid—pilih sesuai pola akses data.'],
            ['Kontrak software yang melindungi klien', 'Manajemen', 'Klausul source code, SLA, dan serah terima yang wajib ada.'],
            ['Budaya code review di tim kecil', 'Teknologi', 'Review ringan tapi konsisten lebih berharga daripada proses berat yang dihindari.'],
        ];

        $categoriesBody = [
            'Panduan' => '<p>Artikel ini merangkum langkah praktis yang bisa langsung diterapkan tim Anda minggu ini.</p><h2>Mulai dari masalah bisnis</h2><p>Jangan mulai dari daftar fitur. Petakan dulu proses yang macet, siapa penggunanya, dan hasil yang diharapkan.</p><h2>Tulis keputusan, bukan hanya keinginan</h2><p>Setiap keputusan ruang lingkup harus tertulis agar estimasi dan pengujian punya acuan yang sama.</p>',
            'Keamanan' => '<p>Keamanan aplikasi harus direncanakan sejak desain, bukan ditambal setelah insiden.</p><h2>Validasi di server</h2><p>Validasi browser mudah dilewati. Aturan bisnis dan sanitasi input harus ditegakkan di backend.</p><h2>Pembaruan berkala</h2><p>Library dan framework punya patch keamanan. Jadwalkan perawatan agar celah lama tidak tetap terbuka.</p>',
            'Sistem' => '<p>Sistem informasi yang baik mengikuti cara kerja organisasi, bukan memaksa tim menyesuaikan template generik.</p><h2>Inventaris proses</h2><p>Catat alur data antar unit. Dari situ baru disusun modul yang benar-benar dipakai.</p><h2>Rencana migrasi</h2><p>Data lama, pelatihan pengguna, dan paralel run sering lebih krusial daripada UI baru.</p>',
            'Manajemen' => '<p>Proyek software gagal lebih sering karena komunikasi dan ruang lingkup, bukan karena bahasa pemrograman.</p><h2>Ritme update</h2><p>Update mingguan yang jujur lebih berguna daripada demo besar di akhir yang mengejutkan semua pihak.</p><h2>Anggaran realistis</h2><p>Sertakan hosting, migrasi data, waktu uji internal, dan perawatan pasca-rilis.</p>',
            'Teknologi' => '<p>Pilihan teknis sebaiknya mengikuti konteks produk: tim, waktu, dan beban pengguna.</p><h2>Trade-off yang jujur</h2><p>Setiap stack punya biaya tersembunyi. Diskusikan performa, hiring, dan perawatan jangka panjang.</p><h2>Bukti, bukan tren</h2><p>Gunakan bukti dari proyek serupa sebelum mengadopsi teknologi hanya karena sedang populer.</p>',
            'Data' => '<p>Keputusan berbasis data hanya berguna jika sumber datanya terpercaya dan terdefinisi.</p><h2>Definisi metrik</h2><p>Sepakati apa yang diukur, dari mana asalnya, dan seberapa sering diperbarui.</p><h2>Kualitas input</h2><p>Dashboard yang indah tidak menolong bila kolom dan kepemilikan data masih berantakan.</p>',
        ];

        foreach ($articles as $index => [$title, $category, $excerpt]) {
            $order = $index + 1;
            $publishedAt = Carbon::parse('2026-10-18 09:00:00')->subDays($index);

            Article::query()->create([
                'slug' => Str::slug($title),
                'title' => $title,
                'excerpt' => $excerpt,
                'body' => $categoriesBody[$category] ?? $categoriesBody['Panduan'],
                'category' => $category,
                'cover_image' => SeederImages::urlForIndex($order - 1),
                'reading_minutes' => 3 + ($index % 5),
                'is_featured' => $order === 1,
                'published_at' => $publishedAt,
            ]);
        }
    }

    private function seedGallery(): void
    {
        $items = [
            ['Diskusi kebutuhan bersama klien', 'Kegiatan', 'lg:col-span-7', 'aspect-[16/10]'],
            ['Tim mengerjakan sprint', 'Kegiatan', 'lg:col-span-5', 'aspect-[4/3] lg:h-full'],
            ['Sesi desain antarmuka', 'Proses', 'lg:col-span-5', 'aspect-[4/3] lg:h-full'],
            ['Presentasi hasil proyek', 'Kegiatan', 'lg:col-span-7', 'aspect-[16/10]'],
            ['Kolaborasi harian tim', 'Kegiatan', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Penghargaan mitra terbaik', 'Prestasi', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Wawancara anggota tim', 'Dokumentasi', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Ruang kerja kantor', 'Fasilitas', 'lg:col-span-5', 'aspect-[4/3] lg:h-full'],
            ['Gathering tim akhir tahun', 'Kegiatan', 'lg:col-span-7', 'aspect-[16/10]'],
            ['Workshop product discovery', 'Proses', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Review kode bersama', 'Proses', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Uji coba aplikasi di lapangan', 'Dokumentasi', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Setup server produksi', 'Proses', 'lg:col-span-7', 'aspect-[16/10]'],
            ['Pelatihan pengguna klien', 'Kegiatan', 'lg:col-span-5', 'aspect-[4/3] lg:h-full'],
            ['Pameran teknologi lokal', 'Prestasi', 'lg:col-span-5', 'aspect-[4/3] lg:h-full'],
            ['Ruang meeting glassbox', 'Fasilitas', 'lg:col-span-7', 'aspect-[16/10]'],
            ['Sesi brainstorming fitur', 'Proses', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Dokumentasi penyerahan proyek', 'Dokumentasi', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Foto bersama klien', 'Kegiatan', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Area coworking internal', 'Fasilitas', 'lg:col-span-7', 'aspect-[16/10]'],
            ['Demo aplikasi mobile', 'Dokumentasi', 'lg:col-span-5', 'aspect-[4/3] lg:h-full'],
            ['Workshop keamanan aplikasi', 'Proses', 'lg:col-span-7', 'aspect-[16/10]'],
            ['Sertifikasi tim engineering', 'Prestasi', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Pojok monitoring NOC', 'Fasilitas', 'lg:col-span-4', 'aspect-[4/3]'],
            ['Kickoff proyek baru', 'Kegiatan', 'lg:col-span-4', 'aspect-[4/3]'],
        ];

        foreach ($items as $index => [$title, $category, $span, $aspect]) {
            $order = $index + 1;

            GalleryItem::query()->create([
                'title' => $title,
                'category' => $category,
                'image_url' => SeederImages::urlForIndex($order + count($items) - 1),
                'span' => $span,
                'aspect' => $aspect,
                'sort_order' => $order,
            ]);
        }
    }

    private function seedContactMessages(): void
    {
        $names = [
            'Andi Pratama', 'Siti Rahayu', 'Budi Santoso', 'Dewi Lestari', 'Eko Wijaya',
            'Fitri Handayani', 'Gilang Ramadhan', 'Hana Putri', 'Irfan Maulana', 'Joko Susilo',
            'Kartika Sari', 'Lukman Hakim', 'Maya Anggraini', 'Nanda Fauzi', 'Oki Permana',
            'Putri Amelia', 'Rendi Saputra', 'Salsa Nabila', 'Taufik Hidayat', 'Umi Kulsum',
            'Vino Aditya', 'Wulan Cahya', 'Yoga Nugraha', 'Zahra Melati', 'Arif Rahman',
        ];

        $companies = [
            'PT Nusantara Digital', 'CV Mitra Bogor', 'PT Prima Logistik', 'UD Sumber Rezeki', 'PT Karya Mandiri',
            'Klinik Sehat Sentosa', 'Sekolah Harapan Bangsa', 'PT Agro Nusantara', 'Toko Online Bahagia', 'PT Media Kreatif',
            'Hotel Puncak Indah', 'PT Finance Solusi', 'Bengkel Motor Jaya', 'PT Retail Nusantara', 'Yayasan Peduli Anak',
            'PT Transport Cepat', 'Kafe Kopi Lokal', 'PT Properti Hijau', 'Laundry Express', 'PT Energi Terbarukan',
            'Salon Cantikku', 'PT Farmasi Sejahtera', 'Studio Foto Moment', 'PT Konstruksi Andal', 'Warung Digital UMKM',
        ];

        $topics = [
            'Permintaan penawaran',
            'Pertanyaan layanan',
            'Jadwal pertemuan',
            'Kerja sama',
            'Dukungan teknis',
            'Lainnya',
        ];

        $messages = [
            'Kami ingin menanyakan estimasi biaya untuk website perusahaan.',
            'Apakah tersedia slot konsultasi minggu depan?',
            'Mohon info paket aplikasi mobile untuk UMKM.',
            'Kami butuh sistem inventori untuk gudang cabang.',
            'Bisa bantu migrasi data dari spreadsheet ke sistem baru?',
            'Ingin diskusi tentang dashboard laporan penjualan.',
            'Apakah ada retainer perawatan setelah go-live?',
            'Kami mencari partner untuk portal berita internal.',
            'Tolong jelaskan perbedaan website katalog dan toko online.',
            'Butuh bantuan integrasi pembayaran di Indonesia.',
        ];

        foreach ($names as $index => $name) {
            $order = $index + 1;

            ContactMessage::query()->create([
                'nama' => $name,
                'email' => Str::slug(explode(' ', $name)[0]).$order.'@contoh.id',
                'telepon' => '08'.str_pad((string) (1500000000 + $order * 137), 10, '0', STR_PAD_LEFT),
                'perusahaan' => $companies[$index],
                'topik' => $topics[$index % count($topics)],
                'pesan' => $messages[$index % count($messages)].' ('.$companies[$index].')',
                'is_read' => $order % 3 === 0,
                'created_at' => Carbon::now()->subDays(25 - $order)->subHours($order),
                'updated_at' => Carbon::now()->subDays(25 - $order)->subHours($order),
            ]);
        }
    }

    private function seedConsultations(): void
    {
        $products = Product::query()->orderBy('sort_order')->get();
        if ($products->isEmpty()) {
            return;
        }

        $names = [
            'Rina Marlina', 'Doni Setiawan', 'Ayu Larasati', 'Bagus Kurniawan', 'Citra Dewi',
            'Fajar Nugroho', 'Gita Prameswari', 'Hendra Gunawan', 'Intan Permata', 'Johan Wijaya',
            'Kirana Putri', 'Leo Pratama', 'Mira Safitri', 'Nico Ramadhan', 'Olivia Tan',
            'Pandu Wibowo', 'Qori Ananda', 'Reza Fadillah', 'Sinta Maharani', 'Tegar Alamsyah',
            'Ursula Chen', 'Vira Kusuma', 'Wahyu Adi', 'Xenia Putri', 'Yuri Santoso',
        ];

        $companies = [
            'PT Digital Bogor', 'CV Tech Nusantara', 'PT Retail Modern', 'Klinik Medika', 'PT Logistik Cepat',
            'Sekolah Cerdas', 'PT Agro Prima', 'Hotel Sentosa', 'PT Finance Ready', 'Toko Bahagia',
            'PT Media Online', 'Yayasan Harapan', 'PT Properti Prima', 'Kafe Lokal', 'PT Energi Hijau',
            'Bengkel Jaya', 'PT Farmasi Sehat', 'Studio Kreatif', 'PT Konstruksi Maju', 'UMKM Digital',
            'Salon Indah', 'PT Transportasi', 'Laundry Cepat', 'Warung Online', 'PT Solusi Bisnis',
        ];

        $needs = [
            'Kami ingin mengganti proses manual dengan sistem yang terintegrasi.',
            'Butuh aplikasi mobile untuk tim lapangan dengan fitur offline.',
            'Website lama sudah lambat; ingin redesign dan CMS mandiri.',
            'Perlu dashboard KPI untuk manajemen cabang.',
            'Ingin toko online lengkap dengan gateway pembayaran.',
            'Mencari sistem HRIS untuk absensi dan cuti karyawan.',
            'Butuh portal internal untuk berbagi dokumen dan berita.',
            'Ingin aplikasi booking jadwal layanan pelanggan.',
            'Perlu migrasi data dari sistem lama tanpa downtime panjang.',
            'Mencari retainer untuk perawatan dan update berkala.',
        ];

        foreach ($names as $index => $name) {
            $order = $index + 1;
            $product = $products[$index % $products->count()];

            Consultation::query()->create([
                'nama' => $name,
                'perusahaan' => $companies[$index],
                'email' => Str::slug(explode(' ', $name)[0]).'.konsul'.$order.'@contoh.id',
                'telepon' => '08'.str_pad((string) (1600000000 + $order * 149), 10, '0', STR_PAD_LEFT),
                'product_id' => $product->id,
                'layanan' => $product->name,
                'anggaran' => $product->budget_range,
                'kebutuhan' => $needs[$index % count($needs)].' Fokus pada paket '.$product->name.'.',
                'is_read' => $order % 4 === 0,
                'created_at' => Carbon::now()->subDays(25 - $order)->subHours($order + 2),
                'updated_at' => Carbon::now()->subDays(25 - $order)->subHours($order + 2),
            ]);
        }
    }
}
