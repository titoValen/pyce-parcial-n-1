<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' | Old Ink School' : 'Old Ink School' }}</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rye&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body id="top">
    <a class="skip-link" href="#main-content">Saltar al contenido</a>
    <header class="site-header">
        <div class="site-header-inner">
            <a class="wordmark" href="{{ route('home') }}" aria-label="Old Ink School, inicio">
                <span class="wordmark-title">Old Ink <span>School</span></span>
                <span class="wordmark-caption">Estudio de tatuajes</span>
            </a>
            <nav class="site-nav" aria-label="Navegación principal">
                <a class="site-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}"
                    href="{{ route('home') }}">
                    Inicio
                </a>
                <a class="site-nav-link {{ request()->routeIs('services*') ? 'is-active' : '' }}"
                    href="{{ route('services.index') }}">Servicios</a>
                <a class="site-nav-link {{ request()->routeIs('blog', 'blog.category', 'blog.show') ? 'is-active' : '' }}"
                    href="{{ route('blog.index') }}">Blog</a>
                <a class="site-nav-link {{ request()->routeIs('appointments*') ? 'is-active' : '' }}"
                    href="{{ route('appointments.create') }}">Turnos</a>
                @auth
                    <a class="site-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}"
                        href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <button class="site-nav-link site-nav-logout" type="submit">
                            {{ auth()->user()->nombre }} (Cerrar sesión)
                        </button>
                    </form>
                @else
                    <a class="site-nav-link {{ request()->routeIs('admin.login') ? 'is-active' : '' }}"
                        href="{{ route('admin.login') }}">Iniciar sesión</a>
                @endauth
            </nav>
        </div>
    </header>

    <main id="main-content" class="site-main">
        {{ $slot }}
    </main>

    <footer class="site-footer">
        <div class="site-footer-inner">
            <a class="footer-wordmark" href="{{ route('home') }}">Old Ink School</a>
            <p>&copy; {{ now()->year }} Old Ink School</p>
            <a class="back-to-top" href="#top">Volver arriba</a>
        </div>
    </footer>
</body>

</html>
