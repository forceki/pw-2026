<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {

            $data = [
                'total_buku'       => Buku::count(),
                'total_kategori'   => Kategori::count(),
                'total_anggota'    => User::where('role', 'siswa')->count(),
                'total_peminjaman' => Peminjaman::where('status', 'dipinjam')->count(),
            ];

            return view('admin.dashboard', $data);
        }


        $peminjaman_aktif = Peminjaman::
                            where('user_id', $user->id)
                            ->where('status', 'dipinjam')
                            ->with('buku')
                            ->get();

        $riwayat = Peminjaman::
                    where('user_id', $user->id)
                    ->where('status', 'kembali')
                    ->with('buku')
                    ->latest()
                    ->take(5)
                    ->get();


        $data = [
            'peminjaman_aktif' => $peminjaman_aktif,
            'riwayat' => $riwayat,
        ];

        return view('siswa.dashboard', $data);
    }
}
