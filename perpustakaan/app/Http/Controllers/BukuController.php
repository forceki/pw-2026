<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;


class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')->latest()->paginate(10);

        return view('buku.index', compact('buku'));
    }

    public function show(Buku $buku)
    {
        $buku->load('kategori');

        return view('buku.show', compact('buku'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('admin.buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id'  => 'required|exists:kategori,id',
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'isbn'         => 'required|string|unique:buku,isbn',
            'stok'         => 'required|integer|min:0',
            'tahun_terbit' => 'required|digits:4',
        ]);

        Buku::create($validated);

        return redirect()->route('admin.buku.index')
                         ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        $kategori = Kategori::all();

        return view('admin.buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'kategori_id'  => 'required|exists:kategori,id',
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'isbn'         => 'required|string|unique:buku,isbn,' . $buku->id,
            'stok'         => 'required|integer|min:0',
            'tahun_terbit' => 'required|digits:4',
        ]);

        $buku->update($validated);

        return redirect()->route('admin.buku.index')
                         ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('admin.buku.index')
                         ->with('success', 'Buku berhasil dihapus.');
    }
}
