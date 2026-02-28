@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <h6 class="fw-bold mb-3">Peminjaman Aktif</h6>

    @if($peminjaman_aktif->count() > 0)
        <div class="row g-3 mb-4">
            @foreach($peminjaman_aktif as $pinjam)
                <div class="col-md-6">
                    <div class="card-box">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fw-bold">{{ $pinjam->buku->judul }}</div>
                                <small class="text-muted">{{ $pinjam->buku->penulis }}</small>
                            </div>
                            <span class="badge bg-dark">Dipinjam</span>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-6">
                                <small class="text-muted d-block">Tgl Pinjam</small>
                                <strong class="small">{{ $pinjam->tanggal_pinjam->format('d M Y') }}</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Batas Kembali</small>
                                <strong class="small {{ $pinjam->tanggal_kembali->isPast() ? 'text-danger' : '' }}">
                                    {{ $pinjam->tanggal_kembali->format('d M Y') }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card-box text-muted text-center py-3 mb-4">Tidak ada peminjaman aktif.</div>
    @endif

    <h6 class="fw-bold mb-3">Riwayat Terakhir</h6>

    @if($riwayat->count() > 0)
        <div class="table-box">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $r)
                        <tr>
                            <td class="fw-semibold">{{ $r->buku->judul }}</td>
                            <td>{{ $r->tanggal_pinjam->format('d M Y') }}</td>
                            <td>{{ $r->tanggal_realisasi?->format('d M Y') ?? '-' }}</td>
                            <td>
                                @if($r->denda > 0)
                                    <span class="text-danger fw-bold">Rp {{ number_format($r->denda, 0, ',', '.') }}</span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="card-box text-muted text-center py-3">Belum ada riwayat peminjaman.</div>
    @endif
@endsection
