<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ToDo List App')</title>

    <!-- Google Fonts & System Font Preload -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Modular CSS Architecture -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', var(--font-family);
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Modular Navigation -->
    @include('partials.navbar')

    <!-- Main Content Application Shell -->
    <main class="app-main">
        <div class="app-container">
            <!-- Global Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <span><strong>Berhasil:</strong> {{ session('success') }}</span>
                    <button type="button" class="alert-close" aria-label="Tutup">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <span><strong>Peringatan:</strong> {{ session('error') }}</span>
                    <button type="button" class="alert-close" aria-label="Tutup">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul style="margin: 0.25rem 0 0 1rem;">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="alert-close" aria-label="Tutup">&times;</button>
                </div>
            @endif

            <!-- Page Specific Content -->
            @yield('content')
        </div>
    </main>

    <!-- Modular Footer -->
    @include('partials.footer')

    <!-- Modular Application JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>

