@extends('layouts.app')
@section('title', 'Edit Buku')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-box">
                <h6 class="fw-bold mb-3">Edit Buku</h6>
                <form method="POST" action="{{ route('admin.buku.update', $buku) }}">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="judul" class="form-label small fw-semibold">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" required>
                            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="kategori_id" class="form-label small fw-semibold">Kategori</label>
                            <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id', $buku->kategori_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="penulis" class="form-label small fw-semibold">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror"
                                   id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required>
                            @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="penerbit" class="form-label small fw-semibold">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
                                   id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required>
                            @error('penerbit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="isbn" class="form-label small fw-semibold">ISBN</label>
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror"
                                   id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn) }}" required>
                            @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="stok" class="form-label small fw-semibold">Stok</label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                   id="stok" name="stok" value="{{ old('stok', $buku->stok) }}" min="0" required>
                            @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="tahun_terbit" class="form-label small fw-semibold">Tahun Terbit</label>
                            <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror"
                                   id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" min="1900" max="2099" required>
                            @error('tahun_terbit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-dark btn-sm">Update</button>
                        <a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
