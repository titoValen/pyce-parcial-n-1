<x-layout.app title="Inicio de sesión">
    <section class="auth-page" aria-labelledby="login-title">
        <div class="auth-card">
            <p class="eyebrow">Área de administración</p>
            <h1 id="login-title">Inicio de sesión</h1>
            <p class="auth-description">Ingresa tus datos para continuar al panel del estudio.</p>

            @if (session('success'))
                <div class="auth-alert" role="status">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="auth-alert" role="alert">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="auth-alert" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="auth-form" action="{{ route('admin.login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        autocomplete="current-password"
                    >
                </div>

                <button class="button button-primary auth-submit" type="submit">Ingresar</button>
            </form>

            <a class="text-link auth-back-link" href="{{ route('home') }}">
                <span aria-hidden="true">&lt;-</span> Volver al sitio
            </a>
        </div>
    </section>
</x-layout.app>
