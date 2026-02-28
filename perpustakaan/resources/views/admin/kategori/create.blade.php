@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-box">
                <h6 class="fw-bold mb-3">Tambah Kategori</h6>
                <form method="POST" action="{{ route('admin.kategori.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label small fw-semibold">Nama Kategori</label>
                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                               id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}" required>
                        @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
