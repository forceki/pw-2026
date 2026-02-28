# Sistem Manajemen Perpustakaan

Aplikasi manajemen perpustakaan berbasis **Laravel** dengan fitur peminjaman buku, pengembalian, perhitungan denda otomatis, dan manajemen user berbasis role.

## Fitur

- **Autentikasi** — Login, Register, Logout (tanpa Breeze)
- **Dashboard** — Statistik untuk admin, ringkasan peminjaman untuk siswa
- **CRUD Kategori** — Kelola kategori/genre buku
- **CRUD Buku** — Kelola data buku perpustakaan
- **CRUD User** — Tambah user dengan role admin atau siswa
- **Peminjaman Buku** — Stok otomatis berkurang, validasi stok habis
- **Pengembalian Buku** — Stok otomatis bertambah, denda Rp 2.000/hari jika terlambat
- **Authorization** — Admin CRUD semua data, siswa hanya lihat buku dan riwayat peminjaman sendiri

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL
- Bootstrap 5 (CDN)
- Blade Template

## Getting Started

### 1. Clone Repository

```bash
git clone <repo-url>
cd perpustakaan
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

```bash
php artisan key:generate
```

Buka `.env` dan atur koneksi database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database

Buat database MySQL dengan nama `perpustakaan`:

```sql
CREATE DATABASE perpustakaan;
```

### 5. Jalankan Migration & Seeder

```bash
php artisan migrate:fresh --seed
```

### 6. Jalankan Server

```bash
php artisan serve
```

Akses di browser: **http://localhost:8000**

## Akun Default

| Role  | Email                    | Password   |
|-------|--------------------------|------------|
| Admin | admin@gmail.com          | password   |
| Siswa | budi@gmail.com           | password   |

## Struktur Database

| Tabel       | Keterangan                                      |
|-------------|--------------------------------------------------|
| users       | Data user (admin/siswa), kolom: nim, role        |
| kategori    | Kategori buku                                    |
| buku        | Data buku, FK ke kategori                        |
| peminjaman  | Transaksi peminjaman, FK ke users dan buku       |

## Logika Bisnis

- **Peminjaman**: Stok buku berkurang otomatis. Tidak bisa pinjam jika stok 0. Menggunakan DB Transaction + Pessimistic Locking.
- **Pengembalian**: Stok buku bertambah otomatis. Denda dihitung otomatis **Rp 2.000/hari** jika tanggal pengembalian melewati batas.
- **Durasi Pinjam**: Default 7 hari dari tanggal peminjaman.

## Route Utama

| URL                              | Akses        | Keterangan            |
|----------------------------------|--------------|-----------------------|
| `/login`                         | Guest        | Halaman login         |
| `/register`                      | Guest        | Halaman register      |
| `/dashboard`                     | Auth         | Dashboard             |
| `/buku`                          | Auth         | Daftar buku           |
| `/peminjaman`                    | Auth         | Riwayat peminjaman    |
| `/admin/kategori`                | Admin        | CRUD kategori         |
| `/admin/buku/create`             | Admin        | Tambah buku           |
| `/admin/peminjaman/create`       | Admin        | Buat peminjaman       |
| `/admin/user`                    | Admin        | Kelola user           |

## License

Open source.
