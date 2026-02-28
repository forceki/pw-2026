<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PeminjamanController extends Controller
{
    
    const DENDA_PER_HARI = 2000;
    const DURASI_PINJAM_HARI = 7;

    public function index()
    {
        $user = Auth::user();

        $query = Peminjaman::with(['user', 'buku.kategori'])->latest();

        if ($user->isSiswa()) {
            $query->where('user_id', $user->id);
        }

        $peminjaman = $query->paginate(10);

        return view('peminjaman.index', compact('peminjaman'));
    }


    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        $users = \App\Models\User::where('role', 'siswa')->get();

        return view('admin.peminjaman.create', compact('buku', 'users'));
    }

    public function pinjamBuku(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:buku,id',
        ]);

        DB::transaction(function () use ($validated) {
            $buku = Buku::lockForUpdate()->findOrFail($validated['buku_id']);
            if ($buku->stok <= 0) {
                abort(422, 'Stok buku habis, tidak bisa meminjam.');
            }

            $buku->decrement('stok');

            Peminjaman::create([
                'user_id'         => $validated['user_id'],
                'buku_id'         => $validated['buku_id'],
                'tanggal_pinjam'  => Carbon::today(),
                'tanggal_kembali' => Carbon::today()->addDays(self::DURASI_PINJAM_HARI),
                'status'          => 'dipinjam',
            ]);
        });

        return redirect()->route('admin.peminjaman.index')
                         ->with('success', 'Buku berhasil dipinjam.');
    }

    public function kembalikanBuku(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'kembali') {
            return back()->withErrors(['error' => 'Buku ini sudah dikembalikan sebelumnya.']);
        }

        $denda = 0;

        DB::transaction(function () use ($peminjaman, &$denda) {
            $tanggalRealisasi = Carbon::today();
            $batasKembali = Carbon::parse($peminjaman->tanggal_kembali);

            if ($tanggalRealisasi->gt($batasKembali)) {
                $selisihHari = $batasKembali->diffInDays($tanggalRealisasi);
                $denda = $selisihHari * self::DENDA_PER_HARI;
            }

            $peminjaman->update([
                'tanggal_realisasi' => $tanggalRealisasi,
                'denda'             => $denda,
                'status'            => 'kembali',
            ]);

            $peminjaman->buku->increment('stok');
        });

        $pesan = 'Buku berhasil dikembalikan.';
        if ($denda > 0) {
            $pesan .= ' Denda keterlambatan: Rp ' . number_format($denda, 0, ',', '.');
        }

        return redirect()->route('admin.peminjaman.index')
                         ->with('success', $pesan);
    }
}
