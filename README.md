# Susilo Apriyansah - Surya Nusantara Kopi (PT Surya Rasa Nusantara)

Website dinamis UMKM **Susilo Apriyansah - Surya Nusantara Kopi** (**PT Surya Rasa Nusantara**) yang dibangun menggunakan **Laravel 12**, **SQLite**, **Eloquent ORM**, dan **Tailwind CSS** untuk UTS Pemrograman Web II (**Susilo Apriyansah — 24312051**).

## Identitas Usaha
- **Nama Website**: Susilo Apriyansah - Surya Nusantara Kopi
- **Nama PT**: PT Surya Rasa Nusantara *(berawalan huruf **S**)*
- **Nama Brand**: Surya Nusantara Kopi
- **Bidang Usaha**: Roastery & Produk Kopi Lokal Nusantara (Biji Kopi Single Origin, Kopi Bubuk Artisan, Minuman Cold Brew, Paket Hampers & Gift)
- **Logo**: `public/images/logo-surya.svg`

## Fitur Utama
1. **Relasi Database & Eloquent**: Tabel `categories` (1) berelasi dengan `products` (N) melalui `category_id` foreign key + tabel `users` untuk autentikasi admin.
2. **Halaman Publik Dinamis**:
   - Beranda (`/`) — Profil usaha PT Surya Rasa Nusantara, logo, statistik dinamis, kategori, dan produk unggulan.
   - Katalog Produk (`/produk`) — Daftar produk dari database dengan filter kategori, pencarian, pengurutan, dan pagination.
   - Detail Produk (`/produk/{slug}`) — Informasi lengkap per item, spesifikasi, tombol pesan WhatsApp, dan produk terkait.
3. **Panel Admin Terproteksi**:
   - Login Admin (`/admin/login`)
   - Dashboard Statistik (`/admin`)
   - CRUD Produk (`/admin/products`) lengkap dengan upload foto ke `storage/app/public/products` dan preview gambar otomatis.
   - CRUD Kategori (`/admin/categories`)
4. **Validasi Server-Side**: Menggunakan `StoreProductRequest`, `UpdateProductRequest`, `StoreCategoryRequest`, dan `UpdateCategoryRequest` (`required`, `min`, `max`, `string`, `integer`, `exists`, `unique`, `image`, `mimes`, `max:2048`).
5. **Seeder Data Contoh**: 4 kategori + 8 produk kopi Nusantara beserta file gambar di `storage/app/public/products/`.

## Cara Menjalankan Project
```bash
# 1. Pastikan symlink storage aktif
php artisan storage:link

# 2. Jalankan migrasi dan seeder (8 produk + 4 kategori + akun admin)
php artisan migrate:fresh --seed

# 3. Jalankan server Laravel
php artisan serve
```

Buka browser di `http://127.0.0.1:8000`.

### Akun Login Admin (Default Seeder)
- **URL**: `http://127.0.0.1:8000/admin/login`
- **Email**: `admin@suryakopi.id`
- **Password**: `password123`

## Pengujian Otomatis
```bash
php artisan test
```
