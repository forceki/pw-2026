@extends('layouts.guest')
@section('title', 'Daftar Akun')

@section('content')
    <div class="brand">
        <i class="bi bi-book"></i>
        <h4>Buat Akun</h4>
        <p>Daftar sebagai anggota perpustakaan</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger py-2 mb-3">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li><small>{{ $error }}</small></li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label small fw-semibold">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label small fw-semibold">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label small fw-semibold">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label small fw-semibold">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label small fw-semibold">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-dark w-100 mb-3">Daftar</button>
        <p class="text-center text-muted small mb-0">
            Sudah punya akun? <a href="{{ route('login') }}" class="fw-semibold">Login</a>
        </p>
    </form>
@endsection
