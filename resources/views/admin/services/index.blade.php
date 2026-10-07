<x-layout.admin title="Servicios">
    <section class="admin-page" aria-labelledby="services-title">
        <div class="admin-page-heading">
            <div>
                <p class="eyebrow">Administración / Catálogo</p>
                <h1 id="services-title">Servicios</h1>
                <p>Gestiona los servicios activos e inactivos del estudio.</p>
            </div>
            <a class="button button-primary" href="{{ route('admin.services.create') }}">Crear servicio</a>
        </div>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Precio base</th>
                        <th scope="col">Duración</th>
                        <th scope="col">Tatuadores</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <th scope="row">{{ $service->nombre }}</th>
                            <td>
                                <span class="admin-status {{ $service->activo ? 'is-published' : 'is-draft' }}">
                                    {{ $service->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>{{ $service->precio_formateado }}</td>
                            <td>{{ $service->duracion_legible }}</td>
                            <td>
                                @if ($service->tattooArtists->isNotEmpty())
                                    {{ $service->tattooArtists->pluck('nombre')->join(', ') }}
                                @else
                                    <span class="admin-muted">Sin tatuadores</span>
                                @endif
                            </td>
                            <td>
                                <div class="admin-row-actions">
                                    <a class="text-link" href="{{ route('admin.services.edit', $service) }}">Editar</a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro que quieres eliminar este servicio?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="admin-delete-button" type="submit">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="admin-empty" colspan="6">Todavía no hay servicios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($services->hasPages())
            <nav class="pagination" aria-label="Paginación de servicios">
                @if ($services->onFirstPage())
                    <span class="pagination-disabled" aria-disabled="true">Anterior</span>
                @else
                    <a href="{{ $services->previousPageUrl() }}">Anterior</a>
                @endif
                <span class="pagination-status">Página {{ $services->currentPage() }} de {{ $services->lastPage() }}</span>
                @if ($services->hasMorePages())
                    <a href="{{ $services->nextPageUrl() }}">Siguiente</a>
                @else
                    <span class="pagination-disabled" aria-disabled="true">Siguiente</span>
                @endif
            </nav>
        @endif
    </section>
</x-layout.admin>
