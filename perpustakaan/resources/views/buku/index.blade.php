@extends('layouts.app')
@section('title', 'Daftar Buku')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar Buku</h6>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.buku.create') }}" class="btn btn-dark btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah
            </a>
        @endif
    </div>

    <div class="table-box">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    @if(auth()->user()->isAdmin())
                        <th style="width:150px">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($buku as $b)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($buku->currentPage() - 1) * $buku->perPage() }}</td>
                        <td>
                            <a href="{{ route('buku.show', $b) }}" class="text-dark text-decoration-none fw-semibold">{{ $b->judul }}</a>
                        </td>
                        <td>{{ $b->penulis }}</td>
                        <td>{{ $b->kategori->nama_kategori }}</td>
                        <td>{{ $b->tahun_terbit }}</td>
                        <td>
                            <span class="badge {{ $b->stok > 0 ? 'bg-dark' : 'bg-danger' }}">{{ $b->stok }}</span>
                        </td>
                        @if(auth()->user()->isAdmin())
                            <td>
                                <a href="{{ route('admin.buku.edit', $b) }}" class="btn btn-sm btn-outline-dark me-1">Edit</a>
                                <form action="{{ route('admin.buku.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-3">Belum ada buku.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $buku->links() }}</div>
@endsection
