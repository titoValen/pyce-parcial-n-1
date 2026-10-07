<x-layout.admin title="Editar servicio">
    <section class="admin-page" aria-labelledby="service-form-title">
        <p class="eyebrow">Administración / Servicios</p>
        <h1 id="service-form-title">Editar servicio</h1>
        <p class="admin-page-description">Actualiza la información y los tatuadores asignados.</p>
        @include('admin.services._form', [
            'formAction' => route('admin.services.update', $service),
            'formMethod' => 'PUT',
        ])
    </section>
</x-layout.admin>
