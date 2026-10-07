<x-layout.admin title="Panel de administración">
    <section class="admin-page dashboard">
        <p class="eyebrow">Old Ink School / Administración</p>
        <h1>Panel de administración</h1>
        <p>Bienvenido al panel de administración.</p>
        <a class="button button-primary admin-dashboard-link" href="{{ route('admin.posts.index') }}">
            Administrar posts
        </a>
        <a class="button button-outline admin-dashboard-link" href="{{ route('admin.services.index') }}">
            Administrar servicios
        </a>
    </section>
</x-layout.admin>
