# Materi Lengkap Asesor — Website PT Solusi Koneksi Anda (Serkom)

Dokumen ini merangkum **seluruh sistem**: konsep, stack, database, frontend (termasuk **kartu 3D**), backend, admin Filament, flow request, alur pembuatan, sampai jawaban siap pakai.

Baca dari atas ke bawah, lalu hafalkan bagian **Q&A** dan **demo checklist**.

---

## Daftar isi

1. [Ringkasan proyek](#1-ringkasan-proyek)
2. [Stack teknologi lengkap](#2-stack-teknologi-lengkap)
3. [Arsitektur MVC & request lifecycle](#3-arsitektur-mvc--request-lifecycle)
4. [Struktur folder](#4-struktur-folder)
5. [Database: skema, relasi, cast](#5-database-skema-relasi-cast)
6. [Routing & controller](#6-routing--controller)
7. [Model Eloquent & helper](#7-model-eloquent--helper)
8. [Frontend publik — layout & desain](#8-frontend-publik--layout--desain)
9. [Kartu 3D hero (detail teknis)](#9-kartu-3d-hero-detail-teknis)
10. [Fitur Alpine lain (lightbox, form)](#10-fitur-alpine-lain-lightbox-form)
11. [Form kontak & konsultasi](#11-form-kontak--konsultasi)
12. [Filament Admin Panel](#12-filament-admin-panel)
13. [View composer & site settings](#13-view-composer--site-settings)
14. [Seeder & data demo](#14-seeder--data-demo)
15. [Keamanan dasar](#15-keamanan-dasar)
16. [Alur pembuatan proyek (end-to-end)](#16-alur-pembuatan-proyek-end-to-end)
17. [Perintah Artisan](#17-perintah-artisan)
18. [Tanya–jawab asesor](#18-tanyajawab-asesor)
19. [Script demo di depan asesor](#19-script-demo-di-depan-asesor)
20. [Glosarium istilah](#20-glosarium-istilah)

---

## 1. Ringkasan proyek

| Item | Keterangan |
|------|------------|
| **Nama** | Website company profile PT Solusi Koneksi Anda |
| **Folder project** | `serkom` |
| **Jenis** | Website dinamis + CMS admin |
| **Pola** | Monolith MVC (satu aplikasi, server-rendered) |
| **Tujuan bisnis** | Menampilkan profil & layanan; menangkap lead via form kontak/konsultasi |
| **Pengguna** | (1) Pengunjung publik (2) Admin konten |

**Pitch 20 detik:**

> Website company profile berbasis **Laravel 12**. Halaman publik di-render **Blade**, distyling **Tailwind**, interaksi **Alpine.js** (termasuk kartu produk **3D CSS** yang berganti tiap 3 detik). Konten dikelola lewat **Filament 3** di `/admin`. Form tersimpan ke database dan muncul di inbox admin.

---

## 2. Stack teknologi lengkap

### 2.1 Backend (server)

| Teknologi | Versi | Peran |
|-----------|-------|--------|
| **PHP** | ^8.2 | Bahasa pemrograman server |
| **Laravel** | ^12 | Framework MVC: routing, Eloquent, validation, Blade, middleware, auth |
| **Filament** | ^3.3 | Admin panel CRUD berbasis Livewire |
| **Livewire** | (via Filament) | Komponen interaktif di admin tanpa banyak JS custom |
| **Eloquent ORM** | built-in | Object-Relational Mapper (Model ↔ tabel) |
| **Carbon** | built-in Laravel | Manipulasi tanggal; locale `id` |
| **Database** | SQLite / MySQL (`.env`) | Penyimpanan data |

### 2.2 Frontend publik (browser)

| Teknologi | Cara load | Peran |
|-----------|-----------|--------|
| **Blade** | Laravel Views | Template HTML dinamis |
| **HTML5 / CSS3** | native | Struktur & efek visual (termasuk **3D transform**) |
| **Tailwind CSS** | CDN di `layouts/app.blade.php` | Utility classes (grid, spacing, warna) |
| **Alpine.js 3** | CDN | State UI: carousel 3D, lightbox, form konsultasi |
| **Montserrat** | Google Fonts | Tipografi utama situs |
| **Material Symbols** | Google Icons | Ikon tombol/UI |

### 2.3 Tools development

| Tool | Fungsi |
|------|--------|
| **Composer** | Dependency PHP (`composer.json`) |
| **npm / package.json** | Ada Vite + Tailwind v4 (default Laravel); publik saat ini lebih andalkan CDN |
| **Artisan** | CLI Laravel |
| **PHPUnit** | Testing (dev) |
| **Pint** | Code style PHP (dev) |

> **Jujur ke asesor:** Frontend publik memakai **CDN Tailwind + Alpine**. Vite tersedia di project, tapi asset halaman company profile belum wajib di-build Vite.

### 2.4 Yang TIDAK dipakai (supaya tidak salah jawab)

- Bukan React / Vue / Next.js untuk halaman publik
- Bukan Three.js / WebGL untuk kartu 3D — ini **CSS 3D Transform** + Alpine
- Bukan REST API terpisah untuk konten utama (masih server-render)

---

## 3. Arsitektur MVC & request lifecycle

### 3.1 MVC

| Lapisan | File contoh | Tanggung jawab |
|---------|-------------|----------------|
| **Model** | `app/Models/Product.php` | Data, relasi, helper format |
| **View** | `resources/views/home.blade.php` | Tampilan HTML |
| **Controller** | `app/Http/Controllers/HomeController.php` | Terima request, query model, kirim ke view |

### 3.2 Lifecycle satu request

```
1. Browser request URL
2. public/index.php → bootstrap Laravel
3. Router cocokkan routes/web.php
4. Middleware (session, CSRF untuk POST, dll.)
5. Controller method dijalankan
6. Model query database (Eloquent)
7. View Blade di-compile jadi HTML
8. Response HTML (+ CSS/JS) ke browser
9. Browser render; Alpine.js mengaktifkan interaksi
```

### 3.3 Dua jenis request

**GET (baca):**
```
User → Route GET → Controller → Model::query() → View → HTML
```

**POST (tulis form):**
```
User submit → Route POST → validate → Model::create → redirect + flash → View
```

---

## 4. Struktur folder

```
serkom/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── ArticleController.php
│   │   ├── ProductController.php
│   │   ├── GalleryController.php
│   │   ├── ContactController.php
│   │   └── ConsultationController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Article.php
│   │   ├── GalleryItem.php
│   │   ├── Consultation.php
│   │   ├── ContactMessage.php
│   │   └── SiteSetting.php
│   ├── Filament/
│   │   ├── Resources/          ← CRUD admin
│   │   └── Pages/              ← ManageSiteSettings
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── Filament/AdminPanelProvider.php
├── database/
│   ├── migrations/
│   └── seeders/ContentSeeder.php
├── resources/views/
│   ├── layouts/app.blade.php   ← layout + font + Tailwind config + Alpine
│   ├── partials/
│   │   ├── navbar.blade.php    ← floating navbar
│   │   ├── footer.blade.php
│   │   ├── page-header.blade.php
│   │   ├── section-head.blade.php
│   │   ├── produk-cards.blade.php
│   │   └── cta.blade.php
│   ├── home.blade.php          ← HERO + kartu 3D
│   ├── tentang.blade.php
│   ├── produk.blade.php
│   ├── artikel.blade.php
│   ├── artikel-show.blade.php
│   ├── galeri.blade.php        ← lightbox
│   ├── kontak.blade.php
│   └── konsultasi.blade.php
├── routes/web.php
├── public/                     ← document root
├── composer.json
├── package.json
└── MATERI-ASESOR.md            ← file ini
```

---

## 5. Database: skema, relasi, cast

### 5.1 ER ringkas

```
users
products ──────────────┐
articles               │ product_id (nullable)
gallery_items          ▼
site_settings (key-value)   consultations
contact_messages
```

### 5.2 Tabel `products`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint PK | |
| slug | string unique | URL-friendly; dipakai `?paket=` |
| name | string | Nama paket |
| label | string | Mis. `01 / Website` |
| description | string | Ringkas |
| features | **json** | Array string fitur |
| price_from | unsigned int | Harga mulai (angka) |
| budget_range | string | Mis. `Rp 10–25 juta` |
| is_highlighted | boolean | Rekomendasi |
| highlight_note | string nullable | |
| sort_order | smallint | Urutan tampil |
| timestamps | | |

### 5.3 Tabel `articles`

| Kolom | Keterangan |
|-------|------------|
| slug | unique; route key detail |
| title, excerpt, body | konten |
| category | kategori |
| cover_image | path lokal atau URL http |
| reading_minutes | estimasi baca |
| is_featured | sorotan |
| published_at | null = belum publish |

Scope: `Article::published()` → `published_at` tidak null & ≤ sekarang.

### 5.4 Tabel `gallery_items`

| Kolom | Keterangan |
|-------|------------|
| title, category | caption |
| image_url | path / URL |
| span | class grid Tailwind (mis. `lg:col-span-7`) |
| aspect | class aspect ratio |
| sort_order | urutan |

### 5.5 Tabel `consultations`

| Kolom | Keterangan |
|-------|------------|
| nama, perusahaan, email, telepon | identitas |
| product_id | FK nullable → products, `nullOnDelete` |
| layanan, anggaran, kebutuhan | isi form |
| is_read | status dibaca admin |

### 5.6 Tabel `contact_messages`

nama, email, telepon, perusahaan, topik, pesan, is_read.

### 5.7 Tabel `site_settings`

Pola **key–value**: `key` + `value`. Dipakai untuk kontak perusahaan, jam kerja, gambar kantor, dll. Di-cache dengan `Cache::rememberForever`.

### 5.8 Relasi Eloquent

```php
// Consultation.php
public function product(): BelongsTo
{
    return $this->belongsTo(Product::class);
}
```

Satu produk bisa punya banyak konsultasi; satu konsultasi opsional terhubung ke satu produk.

---

## 6. Routing & controller

File: `routes/web.php`

| Method | URL | Controller | Nama |
|--------|-----|------------|------|
| GET | `/` | `HomeController` | `home` |
| GET | `/tentang` | view langsung | `tentang` |
| GET | `/produk` | `ProductController@index` | `produk` |
| GET | `/galeri` | `GalleryController@index` | `galeri` |
| GET | `/artikel` | `ArticleController@index` | `artikel` |
| GET | `/artikel/{article}` | `ArticleController@show` | `artikel.show` |
| GET | `/kontak` | `ContactController@show` | `kontak` |
| POST | `/kontak` | `ContactController@store` | `kontak.store` |
| GET | `/konsultasi` | `ConsultationController@create` | `konsultasi` |
| POST | `/konsultasi` | `ConsultationController@store` | `konsultasi.store` |
| GET | `/admin/*` | Filament | panel |

### HomeController — data beranda

```php
'products' => Product::query()->orderBy('sort_order')->take(5)->get(),
'galleryItems' => GalleryItem::query()->orderBy('sort_order')->take(2)->get(),
'articles' => Article::published()->take(3)->get(),
```

- Preview layanan **maksimal 5**
- Galeri preview 2 item
- Artikel 3 terakhir published

---

## 7. Model Eloquent & helper

### Product

- Cast: `features` → array, `is_highlighted` → bool, `price_from` → int
- `formattedPrice()` → `Rp 1.500.000`
- `consultationUrl()` → `route('konsultasi', ['paket' => $this->slug])`
- Route key: `slug`

### Article

- `coverSrc()` → jika URL http(s) pakai langsung; jika path lokal → `Storage::disk('public')->url(...)`
- `formattedDate()` → tanggal Indonesia singkat
- `metaLabel()` → `Kategori · X menit`
- `scopePublished`

### GalleryItem

- `imageSrc()` / `resolveMediaUrl()` — sama pola URL vs storage

### SiteSetting

- `getValue` / `setValue` / `contact()` — array lengkap untuk footer & halaman kontak

---

## 8. Frontend publik — layout & desain

### 8.1 Layout utama

File: `resources/views/layouts/app.blade.php`

Isi penting:
- `<html lang="id" class="dark">`
- Google Fonts Montserrat
- Alpine.js CDN (`defer`)
- Tailwind CDN + `tailwind.config` (warna brand, fontFamily Montserrat, spacing custom)
- `@include('partials.navbar')` → `@yield('content')` → `@include('partials.footer')`

### 8.2 Sistem warna (brand)

| Token / hex | Penggunaan |
|-------------|------------|
| `#0e0e10` | Background utama |
| `#ff2a4b` | Aksen merah / CTA / highlight |
| `#d6012e` | Hover CTA |
| `#201f21` / `#26262a` | Border hairline |
| Putih / `#a1a1aa` | Teks utama / sekunder |

### 8.3 Navbar floating

File: `partials/navbar.blade.php`

Ciri:
- `fixed top-3` + padding horizontal
- Pill/container `rounded-2xl`
- `bg-[#0e0e10]/70 backdrop-blur-xl` (efek kaca)
- Border `border-white/10` + shadow lembut
- Karena `fixed`, keluar dari document flow → halaman dalam butuh `pt-28` / `pt-32` di page-header

**Kalimat untuk asesor:**

> “Navbar dibuat floating agar tidak memakan tinggi layout secara permanen dan terlihat modern di atas hero full-bleed.”

### 8.4 Partial reusable

| Partial | Fungsi |
|---------|--------|
| `page-header` | Judul halaman dalam + deskripsi |
| `section-head` | Nomor section + judul + link/meta |
| `produk-cards` | List produk (dipakai home & produk) |
| `cta` | Ajakan konsultasi di bawah halaman |
| `footer` | Navigasi + kontak dari `$siteContact` |

### 8.5 Animasi halaman (non-3D)

Di `home.blade.php`:
- `home-rise` — teks naik + fade
- `home-image` — background scale-in
- Hormati `prefers-reduced-motion: reduce` (animasi dimatikan)

---

## 9. Kartu 3D hero (detail teknis)

Ini bagian yang sering ditanya. Hafalkan baik-baik.

### 9.1 Apa artinya “3D” di project ini?

**Bukan** model 3D Blender/Three.js.  
Ini **ilusi 3D di browser** memakai:

1. **CSS 3D Transform** (`perspective`, `rotateX`, `rotateY`, `preserve-3d`)
2. **Glassmorphism** (blur + transparansi + border)
3. **Alpine.js** untuk:
   - tilt mengikuti mouse
   - ganti produk tiap **3 detik**
   - indikator titik + pause saat hover

File utama: `resources/views/home.blade.php`

### 9.2 Hierarki elemen DOM

```
.home-hero__stage          ← perspective: 1200px (panggung 3D)
  └─ .home-hero__card-wrap ← animasi masuk + Alpine x-data
       └─ .home-hero__card-float  ← animasi naik-turun (float)
            ├─ .home-hero__card-glow  ← cahaya merah blur di belakang
            └─ article.home-hero__card  ← kartu yang di-rotate
                 └─ konten produk (nama, fitur, harga, CTA)
```

### 9.3 CSS 3D — istilah yang harus bisa dijelaskan

| Property | Nilai di project | Arti |
|----------|------------------|------|
| `perspective` | `1200px` di `.home-hero__stage` | Seberapa “jauh” kamera; semakin kecil semakin dramatis |
| `perspective-origin` | `50% 40%` | Titik pandang kamera |
| `transform-style: preserve-3d` | di wrap/float/card | Anak elemen ikut ruang 3D |
| `rotateY(...)` | default `-14deg` | Putar sumbu vertikal (miring kiri/kanan) |
| `rotateX(...)` | default `8deg` | Putar sumbu horizontal (miring atas/bawah) |
| `will-change: transform` | di card | Optimasi browser untuk animasi transform |
| `transition: transform 180ms` | di card | Gerakan tilt terasa mulus |

**Analogi singkat:**

> `perspective` = seberapa dekat mata kita ke objek.  
> `rotateX/Y` = memiringkan kartu seperti memegang kartu di tangan.

### 9.4 Visual kartu (bukan hanya rotate)

`.home-hero__card-face` memakai:
- Gradient transparan + background gelap semi-opaque
- `backdrop-filter: blur(18px)` → efek kaca di atas foto hero
- Multi-layer `box-shadow` (bayangan dalam + luar + aksen merah tipis)
- Glow terpisah (`.home-hero__card-glow`) dengan `filter: blur` supaya kartu “mengambang” di atas background

Kartu **menimpa background** karena:
- Hero background `position: absolute; inset: 0`
- Konten (teks + kartu) `relative z-10`
- Gradient gelap dari kiri/bawah supaya teks tetap kebaca

### 9.5 Animasi CSS kartu

| Keyframes | Efek |
|-----------|------|
| `home-card-in` | Saat load: muncul dari bawah + sudah dalam pose rotate |
| `home-card-float` | Loop 5.5s: naik-turun 10px (mengambang) |

### 9.6 Data produk ke JavaScript

Di Blade, collection Product diubah jadi array JSON untuk Alpine:

```php
$heroCards = $products->map(fn ($p) => [
    'name' => $p->name,
    'description' => $p->description,
    'features' => collect($p->features)->take(3)->values()->all(),
    'price' => $p->formattedPrice(),
    'url' => $p->consultationUrl(),
    'label' => $p->label,
])->values();
```

Lalu: `x-data="heroProductCard(@js($heroCards))"`

`@js(...)` = helper Blade Laravel yang meng-encode aman ke JavaScript.

### 9.7 Alpine component `heroProductCard`

Fungsi utama:

| Method / state | Fungsi |
|----------------|--------|
| `items` | Array produk |
| `index` | Indeks produk aktif |
| `current` (getter) | Item aktif |
| `leaving` | Flag fade-out sebelum ganti |
| `timer` | `setInterval` 3000 ms |
| `paused` | true saat mouse di atas kartu |
| `rx`, `ry` | sudut rotateX / rotateY |
| `start()` / `stop()` | mulai/hentikan interval |
| `next()` | index berikutnya (modulo) |
| `goTo(i)` | lompat ke produk i (klik titik) |
| `swapTo(i)` | fade out 280ms → ganti index → fade in |
| `onMove(e)` | hitung posisi mouse → update rx/ry |
| `onLeave()` | reset sudut default + resume timer |
| `pause()` / `resume()` | hentikan/jalankan auto-rotate |

**Rumus tilt mouse (inti):**

```js
const rect = e.currentTarget.getBoundingClientRect();
const x = (e.clientX - rect.left) / rect.width;   // 0..1
const y = (e.clientY - rect.top) / rect.height;  // 0..1
this.ry = -18 + (x * 16);
this.rx = 12 - (y * 14);
```

Lalu di HTML:
```html
:style="`transform: rotateY(${ry}deg) rotateX(${rx}deg)`"
```

### 9.8 Auto-ganti tiap 3 detik

```js
this.timer = setInterval(() => {
    if (!this.paused) this.next();
}, 3000);
```

- Hover → `pause()` agar user bisa baca
- Mouse leave → `resume()`
- Klik indikator → `goTo(di)` lalu `start()` ulang

### 9.9 Aksesibilitas gerak

```css
@media (prefers-reduced-motion: reduce) {
  /* semua animasi hero & float dimatikan; kartu tanpa rotate */
}
```

### 9.10 Jawaban siap jika ditanya “kenapa CSS 3D, bukan Three.js?”

> “Karena kebutuhannya kartu produk tipografi, bukan scene 3D kompleks. CSS 3D lebih ringan, tanpa library berat, cukup untuk wow-effect company profile, dan mudah diintegrasikan dengan Alpine untuk data dinamis dari Laravel.”

### 9.11 Flow end-to-end kartu 3D

```
DB products (urut sort_order, take 5)
  → HomeController
  → home.blade.php map ke $heroCards
  → @js ke Alpine heroProductCard
  → CSS perspective + rotate + float + glass
  → setInterval 3s ganti konten
  → tombol “Pilih” → /konsultasi?paket=slug
```

---

## 10. Fitur Alpine lain (lightbox, form)

### 10.1 Galeri lightbox

File: `galeri.blade.php` — fungsi `galleryLightbox(items)`

| Fitur | Implementasi |
|-------|--------------|
| Buka | `@click="open(index)"` |
| Tutup | klik overlay / tombol close / Esc |
| Prev/Next | tombol + ArrowLeft/ArrowRight |
| Lock scroll | `document.body.style.overflow = 'hidden'` saat open |
| Data | title, category, image_url dari `imageSrc()` |

### 10.2 Form konsultasi dinamis

File: `konsultasi.blade.php` — `consultationForm({...})`

- Prefill dari `$selectedProduct` jika URL `?paket=slug`
- Pilih layanan → auto isi `product_id` + `anggaran` dari data produk
- Hidden input `product_id` tersimpan ke DB

---

## 11. Form kontak & konsultasi

### 11.1 Kontak — `ContactController@store`

Validasi tipikal: nama, email, topik, pesan (telepon/perusahaan opsional) → `ContactMessage::create` → redirect success.

### 11.2 Konsultasi — `ConsultationController`

**GET create:**
- Ambil semua produk
- Jika `paket` query ada → cari by slug → `$selectedProduct`

**POST store:**
- Normalisasi `product_id` kosong jadi null
- Validate field
- Jika ada product_id valid → paksa `layanan` & `anggaran` dari produk (konsistensi data)
- `Consultation::create`
- Flash success

### 11.3 Alur bisnis lead

```
Pengunjung lihat paket
  → klik “Pilih paket”
  → form konsultasi terisi
  → submit
  → tersimpan consultations
  → admin buka Filament → inbox Konsultasi → follow-up
```

---

## 12. Filament Admin Panel

### 12.1 Setup panel

File: `AdminPanelProvider.php`

- Path: `/admin`
- Brand: `Solusi Koneksi Anda Admin`
- Warna primary: Rose
- Login wajib (`authMiddleware Authenticate`)
- Auto-discover Resources & Pages

### 12.2 Resource

| Navigasi | Resource | Group |
|----------|----------|-------|
| Produk | `ProductResource` | Konten |
| Artikel | `ArticleResource` | Konten |
| Galeri | `GalleryItemResource` | Konten |
| Konsultasi | `ConsultationResource` | Inbox |
| Pesan Kontak | `ContactMessageResource` | Inbox |
| Pengaturan Situs | `ManageSiteSettings` | Page khusus |

### 12.3 Contoh kemampuan form Produk

- Auto-slug dari nama (`Str::slug` on blur)
- TagsInput untuk features (jadi JSON array)
- Toggle highlight
- Numeric price + budget_range

### 12.4 Kenapa Filament?

> “Admin panel generik cepat: list, create, edit, delete, upload, auth, tanpa bangun UI admin manual.”

Filament berjalan di atas **Livewire** (reaktif di server).

---

## 13. View composer & site settings

Di `AppServiceProvider::boot`:

```php
View::composer(['partials.footer', 'layouts.app'], function ($view) {
    $view->with('siteContact', SiteSetting::contact());
});
```

Artinya navbar/footer otomatis dapat email, telepon, kota, koordinat dari DB — tanpa setiap controller mengirim ulang.

`SiteSetting::getValue` memakai **cache forever**; `setValue` menghapus cache key terkait.

---

## 14. Seeder & data demo

File: `database/seeders/ContentSeeder.php`

| Entitas | Jumlah | Catatan |
|---------|--------|---------|
| Product | 25 | katalog layanan |
| Article | 25 | body HTML sederhana per kategori |
| GalleryItem | 25 | foto `picsum.photos/seed/...` |
| ContactMessage | 25 | inbox demo |
| Consultation | 25 | terhubung product secara bergiliran |

Perintah:
```bash
php artisan db:seed --class=ContentSeeder
```

Seeder **menghapus** data lama jenis tersebut lalu insert ulang (idempotent untuk demo).

---

## 15. Keamanan dasar

| Aspek | Implementasi |
|-------|--------------|
| CSRF | `@csrf` di form; middleware `VerifyCsrfToken` |
| Validasi | `$request->validate([...])` di server |
| XSS Blade | `{{ }}` auto-escape; `{!! !!}` hanya jika sadar HTML |
| Auth admin | Filament login + middleware Authenticate |
| Password | Hash bcrypt (Laravel default User model) |
| Mass assignment | `$fillable` di Model |
| FK integrity | `foreignId()->constrained()->nullOnDelete()` |

---

## 16. Alur pembuatan proyek (end-to-end)

Ceritakan ke asesor dengan urutan ini:

### Tahap A — Bootstrap
1. `composer create-project laravel/laravel`
2. Setup `.env`, `php artisan key:generate`
3. Siapkan database, `php artisan migrate`

### Tahap B — UI statis
1. Layout Blade + navbar/footer
2. Semua halaman company profile (hardcode dulu)
3. Tailwind + Montserrat + warna brand
4. Alpine untuk interaksi dasar

### Tahap C — Domain data
1. Migration tabel konten & inbox
2. Model + casts + helper
3. Relasi consultation–product

### Tahap D — Dinamis publik
1. Controller + route
2. Ganti hardcode dengan Eloquent
3. Form POST + validasi + flash
4. Prefill konsultasi dari slug produk

### Tahap E — Seeder
1. ContentSeeder 25× masing-masing
2. Foto online picsum

### Tahap F — Filament
1. `composer require filament/filament:"^3.3"`
2. Install panel, buat admin user
3. Resource CRUD + inbox + site settings

### Tahap G — Polish visual (yang “wow”)
1. Navbar floating glass
2. Hero full-bleed
3. **Kartu 3D CSS** + mouse tilt
4. **Carousel produk 3 detik**
5. Lightbox galeri
6. Preview home max 5 produk

---

## 17. Perintah Artisan

```bash
php artisan serve
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed --class=ContentSeeder
php artisan make:model Product -m
php artisan make:controller ProductController
php artisan make:filament-resource Product --generate
php artisan route:list
php artisan tinker
php artisan storage:link          # jika pakai upload lokal
```

Jalankan lokal biasanya: `http://127.0.0.1:8000`  
Admin: `http://127.0.0.1:8000/admin`

---

## 18. Tanya–jawab asesor

### Umum
**Q: Framework apa?**  
Laravel 12 + Filament 3. Frontend Blade + Tailwind + Alpine.

**Q: MVC itu apa?**  
Pemisahan Model (data), View (tampilan), Controller (alur).

**Q: Monolith atau microservice?**  
Monolith — satu aplikasi cukup untuk company profile.

### Frontend / 3D
**Q: Kartu 3D pakai library apa?**  
Tidak pakai Three.js. Pakai **CSS 3D transform** (`perspective`, `rotateX/Y`) + **Alpine.js** untuk interaksi.

**Q: Apa itu perspective?**  
Property CSS yang membuat ruang 3D; menentukan “jarak kamera” ke elemen yang di-transform.

**Q: Kenapa kartu ikut mouse?**  
Mousemove menghitung posisi relatif di dalam kartu (0–1), lalu diubah ke sudut `rx`/`ry`.

**Q: Kenapa ganti tiap 3 detik?**  
Supaya banyak paket terlihat tanpa scroll; diimplementasi `setInterval(3000)` dan pause on hover.

**Q: Navbar floating itu apa?**  
Navbar `position: fixed` mengambang dengan blur/transparansi di atas konten, bukan bar penuh nempel klasik.

### Backend
**Q: Eloquent?**  
ORM Laravel: query dengan class Model, bukan SQL mentah di mana-mana.

**Q: Migration?**  
Versi skema DB dalam kode; dijalankan `php artisan migrate`.

**Q: Seeder?**  
Mengisi data demo agar presentasi tidak kosong.

**Q: Validasi di mana?**  
Controller `store`, method `$request->validate()`.

**Q: CSRF?**  
Token rahasia di form mencegah request palsu dari situs lain.

### Admin
**Q: Filament?**  
Paket admin panel Laravel (CRUD, login, form, table) berbasis Livewire.

**Q: Bagaimana konten sampai ke publik?**  
Admin simpan ke DB → Controller publik query → Blade render.

**Q: Site settings?**  
Tabel key-value + cache; footer/kontak dinamis tanpa ubah kode.

### Desain sistem
**Q: Kenapa features JSON?**  
Jumlah fitur fleksibel; cukup array di satu kolom untuk kasus ini.

**Q: Kenapa slug?**  
URL ramah manusia & SEO; dipakai route model binding & query paket.

**Q: Kelebihan pendekatan ini?**  
Cepat develop, satu codebase, admin siap pakai, cocok lead-gen company profile.

**Q: Kekurangan / improvement?**  
Bundle Vite production; email notifikasi form; captcha/rate-limit spam; mungkin API nanti jika ada mobile app.

---

## 19. Script demo di depan asesor

Urutan disarankan (±5–7 menit):

1. **Buka beranda** — sebut brand, tunjukkan navbar floating.  
2. **Tunjuk kartu 3D** — gerakkan mouse (tilt), tunggu 3 detik (ganti produk), klik titik.  
3. **Scroll layanan** — “preview max 5, lengkap di halaman Produk”.  
4. **Produk → Pilih paket** — tunjukkan prefill konsultasi.  
5. **Submit konsultasi** — success message.  
6. **Login `/admin`** — buka inbox Konsultasi, tunjukkan data baru.  
7. **Edit 1 produk/artikel** — refresh publik, tunjukkan berubah.  
8. **Galeri lightbox** — buka, panah, Esc.  
9. **Tunjuk kode** (opsional): `routes/web.php`, `HomeController`, cuplikan CSS `perspective` di `home.blade.php`, 1 Filament Resource.

---

## 20. Glosarium istilah

| Istilah | Arti singkat |
|---------|--------------|
| **MVC** | Model–View–Controller |
| **ORM** | Object-Relational Mapper |
| **Blade** | Template engine Laravel |
| **Eloquent** | ORM bawaan Laravel |
| **Migration** | Skema DB ber-versi |
| **Seeder** | Pengisi data awal |
| **Middleware** | Filter request (auth, CSRF, session) |
| **CSRF** | Cross-Site Request Forgery protection |
| **Slug** | Identifier URL dari judul |
| **CDN** | Content Delivery Network (load library dari URL) |
| **Alpine.js** | JS reaktif ringan berbasis atribut HTML |
| **Livewire** | Komponen PHP reaktif (dipakai Filament) |
| **Filament** | Admin panel Laravel |
| **Glassmorphism** | UI kaca: blur + transparansi |
| **CSS 3D Transform** | Memutar/menggeser elemen di ruang 3D via CSS |
| **Perspective** | Kedalaman kamera CSS 3D |
| **Backdrop-filter** | Blur konten di belakang elemen |
| **View composer** | Inject data otomatis ke view tertentu |
| **Flash session** | Pesan sekali tampil setelah redirect |
| **Foreign key** | Kolom penghubung antar tabel |
| **Cast** | Konversi tipe kolom otomatis di Model |
| **SSR / server-render** | HTML digenerate di server (bukan SPA murni) |

---

## Lampiran A — Elevator pitch (hafalan)

> Saya membangun website company profile **PT Solusi Koneksi Anda** dengan **Laravel 12** berpola **MVC**. Frontend memakai **Blade**, **Tailwind**, dan **Alpine.js**. Di beranda ada **kartu produk bergaya 3D** menggunakan **CSS perspective dan rotateX/Y**, bisa **tilt mengikuti mouse**, dan **berganti produk otomatis setiap 3 detik**. Navbar dibuat **floating** dengan efek glass. Seluruh konten dan inbox form dikelola lewat **Filament 3** di `/admin`, sehingga admin bisa mengubah data tanpa mengubah kode. Form konsultasi terhubung ke produk lewat slug, tersimpan di database, lalu ditindaklanjuti dari panel admin.

---

## Lampiran B — File “wajib hafal lokasi”

| Topik | File |
|-------|------|
| Route | `routes/web.php` |
| Beranda + 3D | `resources/views/home.blade.php` |
| Layout / font / Tailwind | `resources/views/layouts/app.blade.php` |
| Navbar floating | `resources/views/partials/navbar.blade.php` |
| Form konsultasi | `app/Http/Controllers/ConsultationController.php` |
| Model produk | `app/Models/Product.php` |
| Seeder | `database/seeders/ContentSeeder.php` |
| Panel admin | `app/Providers/Filament/AdminPanelProvider.php` |
| Resource produk | `app/Filament/Resources/ProductResource.php` |
| Share kontak | `app/Providers/AppServiceProvider.php` |

---

*Disusun dari codebase aktual proyek Serkom. Sesuaikan kredensial admin lokal sebelum ujian/demo.*
