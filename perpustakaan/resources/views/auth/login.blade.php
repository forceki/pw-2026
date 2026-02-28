@extends('layouts.guest')
@section('title', 'Login')

@section('content')
    <div class="brand">
        <i class="bi bi-book"></i>
        <h4>Perpustakaan</h4>
        <p>Silakan login untuk melanjutkan</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger py-2 mb-3">
            @foreach($errors->all() as $error)
                <small>{{ $error }}</small>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label small fw-semibold">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label small fw-semibold">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label small" for="remember">Ingat saya</label>
        </div>
        <button type="submit" class="btn btn-dark w-100 mb-3">Login</button>
        <p class="text-center text-muted small mb-0">
            Belum punya akun? <a href="{{ route('register') }}" class="fw-semibold">Daftar</a>
        </p>
    </form>
@endsection
