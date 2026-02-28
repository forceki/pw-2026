@extends('layouts.app')
@section('title', 'Kelola Kategori')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar Kategori</h6>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-dark btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah
        </a>
    </div>

    <div class="table-box">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width:50px">#</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Buku</th>
                    <th style="width:180px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $k)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($kategori->currentPage() - 1) * $kategori->perPage() }}</td>
                        <td class="fw-semibold">{{ $k->nama_kategori }}</td>
                        <td>{{ $k->buku_count }}</td>
                        <td>
                            <a href="{{ route('admin.kategori.edit', $k) }}" class="btn btn-sm btn-outline-dark me-1">Edit</a>
                            <form action="{{ route('admin.kategori.destroy', $k) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-3">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $kategori->links() }}</div>
@endsection
