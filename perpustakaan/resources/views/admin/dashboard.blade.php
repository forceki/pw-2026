@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card-box">
                <div class="text-muted small">Total Buku</div>
                <div class="fs-3 fw-bold">{{ $total_buku }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box">
                <div class="text-muted small">Total Kategori</div>
                <div class="fs-3 fw-bold">{{ $total_kategori }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box">
                <div class="text-muted small">Total Anggota</div>
                <div class="fs-3 fw-bold">{{ $total_anggota }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box">
                <div class="text-muted small">Sedang Dipinjam</div>
                <div class="fs-3 fw-bold">{{ $total_peminjaman }}</div>
            </div>
        </div>
    </div>

    <h6 class="fw-bold mb-3">Aksi Cepat</h6>
    <div class="row g-3">
        <div class="col-md-3">
            <a href="{{ route('admin.peminjaman.create') }}" class="text-decoration-none text-dark">
                <div class="card-box text-center py-4">
                    <i class="bi bi-clipboard-plus fs-3"></i>
                    <div class="small fw-semibold mt-2">Buat Peminjaman</div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.buku.create') }}" class="text-decoration-none text-dark">
                <div class="card-box text-center py-4">
                    <i class="bi bi-plus-circle fs-3"></i>
                    <div class="small fw-semibold mt-2">Tambah Buku</div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.kategori.index') }}" class="text-decoration-none text-dark">
                <div class="card-box text-center py-4">
                    <i class="bi bi-tags fs-3"></i>
                    <div class="small fw-semibold mt-2">Kelola Kategori</div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.user.index') }}" class="text-decoration-none text-dark">
                <div class="card-box text-center py-4">
                    <i class="bi bi-people fs-3"></i>
                    <div class="small fw-semibold mt-2">Kelola User</div>
                </div>
            </a>
        </div>
    </div>
@endsection
