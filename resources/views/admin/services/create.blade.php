<x-layout.admin title="Crear servicio">
    <section class="admin-page" aria-labelledby="service-form-title">
        <p class="eyebrow">Administración / Servicios</p>
        <h1 id="service-form-title">Crear servicio</h1>
        <p class="admin-page-description">Completa los datos y asigna los tatuadores correspondientes.</p>
        @include('admin.services._form', [
            'formAction' => route('admin.services.store'),
            'formMethod' => 'POST',
        ])
    </section>
</x-layout.admin>
