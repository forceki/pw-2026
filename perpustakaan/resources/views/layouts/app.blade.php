<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Manajemen Perpustakaan">
    <title>@yield('title', 'Perpustakaan') - Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
        body { background: #f5f5f5; margin: 0; }

        /* Sidebar */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #111;
            color: #999;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }
        .sidebar .brand {
            padding: 1.25rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            border-bottom: 1px solid #222;
            letter-spacing: 0.5px;
        }
        .sidebar .nav-link {
            color: #888;
            padding: 0.6rem 1.5rem;
            font-size: 0.875rem;
            transition: all 0.15s;
        }
        .sidebar .nav-link:hover { color: #fff; background: #1a1a1a; }
        .sidebar .nav-link.active { color: #fff; background: #222; }
        .sidebar .nav-link i { margin-right: 0.6rem; width: 18px; text-align: center; }
        .sidebar .section-label {
            padding: 0.5rem 1.5rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #555;
            font-weight: 600;
        }

        /* Main */
        .main-content { margin-left: 240px; min-height: 100vh; }
        .top-bar {
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .content-area { padding: 1.5rem; }

        /* Cards */
        .card-box {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 1.25rem;
        }

        /* Table */
        .table-box {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            overflow: hidden;
        }
        .table-box .table { margin-bottom: 0; }
        .table-box .table th {
            background: #fafafa;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #666;
            border-bottom: 1px solid #e0e0e0;
        }
        .table-box .table td { vertical-align: middle; }

        /* Badges */
        .badge-status-dipinjam { background: #333; color: #fff; }
        .badge-status-kembali { background: #e0e0e0; color: #333; }

        /* Buttons - monochrome */
        .btn-dark { background: #111; border-color: #111; }
        .btn-dark:hover { background: #333; border-color: #333; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand">
            <i class="bi bi-book"></i> Perpustakaan
        </div>
        <nav class="mt-2">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Dashboard
            </a>
            <a href="{{ route('buku.index') }}" class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i> Daftar Buku
            </a>
            <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Peminjaman
            </a>

            @if(auth()->user()->isAdmin())
                <div class="section-label mt-3">Admin</div>
                <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Kategori
                </a>
                <a href="{{ route('admin.buku.create') }}" class="nav-link {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i> Tambah Buku
                </a>
                <a href="{{ route('admin.peminjaman.create') }}" class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-plus"></i> Buat Peminjaman
                </a>
                <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Kelola User
                </a>
            @endif
        </nav>
    </aside>

    <div class="main-content">
        <div class="top-bar">
            <h6 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h6>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small">
                    <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                    <span class="badge bg-dark ms-1">{{ ucfirst(auth()->user()->role) }}</span>
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-dark">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-dark alert-dismissible fade show py-2" role="alert">
                    <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
