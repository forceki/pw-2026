@extends('layouts.app')
@section('title', auth()->user()->isAdmin() ? 'Semua Peminjaman' : 'Riwayat Peminjaman')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">
            {{ auth()->user()->isAdmin() ? 'Semua Peminjaman' : 'Riwayat Peminjaman' }}
        </h6>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-dark btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Buat Peminjaman
            </a>
        @endif
    </div>

    <div class="table-box">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    @if(auth()->user()->isAdmin())
                        <th>Peminjam</th>
                    @endif
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Tgl Kembali</th>
                    <th>Denda</th>
                    <th>Status</th>
                    @if(auth()->user()->isAdmin())
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $p)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($peminjaman->currentPage() - 1) * $peminjaman->perPage() }}</td>
                        @if(auth()->user()->isAdmin())
                            <td>
                                <div class="fw-semibold">{{ $p->user->name }}</div>
                                <small class="text-muted">{{ $p->user->nim }}</small>
                            </td>
                        @endif
                        <td class="fw-semibold">{{ $p->buku->judul }}</td>
                        <td>{{ $p->tanggal_pinjam->format('d M Y') }}</td>
                        <td>
                            <span class="{{ $p->status === 'dipinjam' && $p->tanggal_kembali->isPast() ? 'text-danger fw-bold' : '' }}">
                                {{ $p->tanggal_kembali->format('d M Y') }}
                            </span>
                        </td>
                        <td>{{ $p->tanggal_realisasi?->format('d M Y') ?? '-' }}</td>
                        <td>
                            @if($p->denda > 0)
                                <span class="text-danger fw-bold">Rp {{ number_format($p->denda, 0, ',', '.') }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $p->status === 'dipinjam' ? 'badge-status-dipinjam' : 'badge-status-kembali' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        @if(auth()->user()->isAdmin())
                            <td>
                                @if($p->status === 'dipinjam')
                                    <form action="{{ route('admin.peminjaman.kembali', $p) }}" method="POST"
                                          onsubmit="return confirm('Konfirmasi pengembalian?')">
                                        @csrf @method('PUT')
                                        <button class="btn btn-sm btn-outline-dark">Kembalikan</button>
                                    </form>
                                @else
                                    <span class="text-muted small">Selesai</span>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center text-muted py-3">Belum ada data peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $peminjaman->links() }}</div>
@endsection
