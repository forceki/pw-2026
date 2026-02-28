<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') - Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
        body {
            min-height: 100vh;
            background: #111;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: #fff;
            border-radius: 8px;
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.3);
        }
        .auth-card .brand { text-align: center; margin-bottom: 1.5rem; }
        .auth-card .brand i { font-size: 2rem; color: #111; }
        .auth-card .brand h4 { font-weight: 700; color: #111; margin-top: 0.5rem; }
        .auth-card .brand p { color: #888; font-size: 0.85rem; }
        .form-control {
            border-radius: 4px;
            padding: 0.6rem 0.75rem;
            border: 1px solid #ddd;
        }
        .form-control:focus { border-color: #111; box-shadow: 0 0 0 2px rgba(0,0,0,0.1); }
        .btn-dark { background: #111; border: none; border-radius: 4px; padding: 0.6rem; font-weight: 600; }
        .btn-dark:hover { background: #333; }
        a { color: #111; }
    </style>
</head>
<body>
    <div class="auth-card">
        @yield('content')
    </div>
</body>
</html>
