<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' | Administración | Old Ink School' : 'Administración | Old Ink School' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rye&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body id="top" class="admin-layout">
    <a class="skip-link" href="#main-content">Saltar al contenido</a>
    <header class="site-header admin-header">
        <div class="site-header-inner">
            <a class="wordmark" href="{{ route('admin.dashboard') }}" aria-label="Old Ink School, administración">
                <span class="wordmark-title">Old Ink <span>School</span></span>
                <span class="wordmark-caption">Administración</span>
            </a>
            <nav class="site-nav admin-nav" aria-label="Navegación de administración">
                <a class="site-nav-link {{ request()->routeIs('admin.posts.*') ? 'is-active' : '' }}"
                    href="{{ route('admin.posts.index') }}">Posts</a>
                <a class="site-nav-link {{ request()->routeIs('admin.services.*') ? 'is-active' : '' }}"
                    href="{{ route('admin.services.index') }}">Servicios</a>
                <span class="site-nav-link admin-nav-disabled" aria-disabled="true"
                    title="Sección todavía no disponible">Solicitudes</span>
                <span class="admin-user-name">{{ auth()->user()->nombre }}</span>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="site-nav-link site-nav-logout" type="submit">Cerrar sesión</button>
                </form>
            </nav>
        </div>
    </header>

    <main id="main-content" class="site-main">
        @if (session('success'))
            <div class="admin-flash" role="status">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="admin-flash admin-flash-error" role="alert">{{ session('error') }}</div>
        @endif
        {{ $slot }}
    </main>

    <footer class="site-footer">
        <div class="site-footer-inner">
            <a class="footer-wordmark" href="{{ route('admin.dashboard') }}">Old Ink School</a>
            <p>&copy; {{ now()->year }} Old Ink School</p>
        </div>
    </footer>
</body>

</html>
