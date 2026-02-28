@extends('layouts.app')
@section('title', 'Buat Peminjaman')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-box">
                <h6 class="fw-bold mb-3">Form Peminjaman Buku</h6>
                <form method="POST" action="{{ route('admin.peminjaman.pinjam') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="user_id" class="form-label small fw-semibold">Peminjam (Siswa)</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                        {{ $u->name }} ({{ $u->nim }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="buku_id" class="form-label small fw-semibold">Buku</label>
                            <select class="form-select @error('buku_id') is-invalid @enderror" id="buku_id" name="buku_id" required>
                                <option value="">-- Pilih Buku --</option>
                                @foreach($buku as $b)
                                    <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                        {{ $b->judul }} (Stok: {{ $b->stok }})
                                    </option>
                                @endforeach
                            </select>
                            @error('buku_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-3 p-2 rounded small" style="background:#f5f5f5; color:#666;">
                        Durasi peminjaman: <strong>7 hari</strong> &middot; Denda keterlambatan: <strong>Rp 2.000/hari</strong>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-dark btn-sm">Proses Peminjaman</button>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
