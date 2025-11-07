<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekai Gallery Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background: #f5f5f5;
        }
        .card {
            margin-bottom: 20px;
        }
        .asset-preview {
            max-width: 200px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .tag-badge {
            margin: 2px;
        }
        .filter-panel {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .filter-panel label {
            color: white;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        .filter-panel .form-check-label {
            color: #333;
            background: rgba(255, 255, 255, 0.9);
            padding: 4px 10px;
            border-radius: 12px;
            transition: all 0.2s;
        }
        .filter-panel .form-check-input:checked + .form-check-label {
            background: #667eea;
            color: white;
            font-weight: 600;
        }
        .filter-panel .form-check {
            padding-left: 0;
        }
        .filter-panel .form-check-input {
            display: none;
        }
        .filter-panel .form-check-label {
            cursor: pointer;
            user-select: none;
        }
        .filter-panel .form-check-label:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('assets.index') }}">🎨 Sekai Gallery Admin</a>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link btn btn-primary btn-sm" href="{{ route('assets.create') }}">➕ Add New Asset</a>
                </div>
            </div>
        </nav>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
