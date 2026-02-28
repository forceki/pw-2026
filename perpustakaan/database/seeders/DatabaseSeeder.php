<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'nim'  => 'ADM001',
            'role'     => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@gmail.com',
            'nim'  => '2026001',
            'role'     => 'siswa',
            'password' => bcrypt('password'),
        ]);


        $fiksi     = Kategori::create(['nama_kategori' => 'Fiksi']);
        $nonfiksi  = Kategori::create(['nama_kategori' => 'Non-Fiksi']);
        $sains     = Kategori::create(['nama_kategori' => 'Sains & Teknologi']);
        $sejarah   = Kategori::create(['nama_kategori' => 'Sejarah']);


        Buku::create([
            'kategori_id'  => $fiksi->id,
            'judul'        => 'Laskar Pelangi',
            'penulis'      => 'Andrea Hirata',
            'penerbit'     => 'Bentang Pustaka',
            'isbn'         => '978-979-1227-28-0',
            'stok'         => 5,
            'tahun_terbit' => 2005,
        ]);

        Buku::create([
            'kategori_id'  => $fiksi->id,
            'judul'        => 'Bumi Manusia',
            'penulis'      => 'Pramoedya Ananta Toer',
            'penerbit'     => 'Hasta Mitra',
            'isbn'         => '978-979-441-088-4',
            'stok'         => 3,
            'tahun_terbit' => 1980,
        ]);

        Buku::create([
            'kategori_id'  => $nonfiksi->id,
            'judul'        => 'Filosofi Teras',
            'penulis'      => 'Henry Manampiring',
            'penerbit'     => 'Kompas Gramedia',
            'isbn'         => '978-602-412-478-9',
            'stok'         => 4,
            'tahun_terbit' => 2018,
        ]);

        Buku::create([
            'kategori_id'  => $sains->id,
            'judul'        => 'Sapiens: Riwayat Singkat Umat Manusia',
            'penulis'      => 'Yuval Noah Harari',
            'penerbit'     => 'Gramedia',
            'isbn'         => '978-602-03-2553-8',
            'stok'         => 2,
            'tahun_terbit' => 2011,
        ]);

        Buku::create([
            'kategori_id'  => $sejarah->id,
            'judul'        => 'Sejarah Indonesia Modern',
            'penulis'      => 'M.C. Ricklefs',
            'penerbit'     => 'Gadjah Mada University Press',
            'isbn'         => '978-979-420-188-4',
            'stok'         => 3,
            'tahun_terbit' => 2008,
        ]);
    }
}
