@extends('layouts.app')
@section('title', 'Detail Buku')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $buku->judul }}</h5>
                        <span class="badge bg-dark">{{ $buku->kategori->nama_kategori }}</span>
                    </div>
                    <span class="badge {{ $buku->stok > 0 ? 'bg-dark' : 'bg-danger' }} fs-6">
                        Stok: {{ $buku->stok }}
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f5f5f5;">
                            <small class="text-muted d-block">Penulis</small>
                            <strong>{{ $buku->penulis }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f5f5f5;">
                            <small class="text-muted d-block">Penerbit</small>
                            <strong>{{ $buku->penerbit }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f5f5f5;">
                            <small class="text-muted d-block">ISBN</small>
                            <strong>{{ $buku->isbn }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f5f5f5;">
                            <small class="text-muted d-block">Tahun Terbit</small>
                            <strong>{{ $buku->tahun_terbit }}</strong>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-dark btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
