@extends('layouts.app')
@section('title', 'Kelola User')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Daftar User</h6>
        <a href="{{ route('admin.user.create') }}" class="btn btn-dark btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah User
        </a>
    </div>

    <div class="table-box">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tgl Daftar</th>
                    <th style="width:180px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td class="fw-semibold">{{ $u->name }}</td>
                        <td>{{ $u->nim }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge {{ $u->role === 'admin' ? 'bg-dark' : 'bg-secondary' }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>
                        <td>{{ $u->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.user.edit', $u) }}" class="btn btn-sm btn-outline-dark me-1">Edit</a>
                            <form action="{{ route('admin.user.destroy', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-3">Belum ada user.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $users->links() }}</div>
@endsection
