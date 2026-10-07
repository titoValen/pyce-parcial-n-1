<x-layout.app title="Cerrar sesión">
    <section class="auth-page" aria-labelledby="logout-title">
        <div class="auth-card auth-card-confirmation">
            <p class="eyebrow">Área de administración</p>
            <h1 id="logout-title">Sesión cerrada</h1>
            <p class="auth-description">Has cerrado tu sesión correctamente.</p>

            <div class="auth-actions">
                <a class="button button-primary" href="{{ route('home') }}">Volver al inicio</a>
                <a class="text-link" href="{{ route('admin.login') }}">Iniciar sesión nuevamente</a>
            </div>
        </div>
    </section>
</x-layout.app>
