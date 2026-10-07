<x-layout.admin title="Solicitudes de turno">
    <section class="admin-page" aria-labelledby="appointments-title">
        <div class="admin-page-heading">
            <div>
                <p class="eyebrow">Administración / Turnos</p>
                <h1 id="appointments-title">Solicitudes de turno</h1>
                <p>Revisa las solicitudes recibidas y actualiza su estado.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="admin-validation-summary" role="alert">
                <p>No se pudo actualizar el estado.</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <nav class="appointment-filters" aria-label="Filtrar solicitudes por estado">
            <a class="{{ $filter === null ? 'is-active' : '' }}"
                href="{{ route('admin.appointments.index') }}">Todas</a>
            @foreach ($filterLabels as $state => $label)
                <a class="{{ $filter === $state ? 'is-active' : '' }}"
                    href="{{ route('admin.appointments.index', ['estado' => $state]) }}">{{ $label }}</a>
            @endforeach
        </nav>

        <div class="admin-table-wrap">
            <table class="admin-table appointment-table">
                <caption class="admin-table-caption">
                    @if ($filter)
                        Solicitudes con estado: {{ $stateLabels[$filter] }}
                    @else
                        Todas las solicitudes de turno
                    @endif
                </caption>
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Servicio</th>
                        <th scope="col">Fecha tentativa</th>
                        <th scope="col">Recibida</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appointments as $appointment)
                        <tr>
                            <th scope="row">
                                <a class="appointment-client-link"
                                    href="{{ route('admin.appointments.show', $appointment) }}">
                                    {{ $appointment->nombre }}
                                </a>
                            </th>
                            <td>{{ $appointment->service?->nombre ?? 'Servicio no disponible' }}</td>
                            <td>{{ $appointment->fecha_tentativa->format('d/m/Y H:i') }}</td>
                            <td>{{ $appointment->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="appointment-status appointment-status--{{ $appointment->estado }}">
                                    {{ $stateLabels[$appointment->estado] ?? ucfirst($appointment->estado) }}
                                </span>
                            </td>
                            <td>
                                <div class="appointment-actions">
                                    <form class="appointment-state-form"
                                        action="{{ route('admin.appointments.update', $appointment) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label class="sr-only" for="estado-{{ $appointment->id }}">Cambiar estado de
                                            {{ $appointment->nombre }}</label>
                                        <select id="estado-{{ $appointment->id }}" name="estado">
                                            @foreach ($stateLabels as $state => $label)
                                                <option value="{{ $state }}"
                                                    @selected($appointment->estado === $state)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <button class="button button-outline appointment-update-button"
                                            type="submit">Actualizar</button>
                                    </form>
                                    <form action="{{ route('admin.appointments.destroy', $appointment) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que quieres eliminar esta solicitud?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="admin-delete-button" type="submit">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="admin-empty" colspan="6">
                                @if ($filter)
                                    No hay solicitudes con estado {{ strtolower($stateLabels[$filter]) }}.
                                @else
                                    Todavía no hay solicitudes de turno.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($appointments->hasPages())
            <nav class="pagination" aria-label="Paginación de solicitudes">
                @if ($appointments->onFirstPage())
                    <span class="pagination-disabled" aria-disabled="true">Anterior</span>
                @else
                    <a href="{{ $appointments->previousPageUrl() }}">Anterior</a>
                @endif
                <span class="pagination-status">Página {{ $appointments->currentPage() }} de
                    {{ $appointments->lastPage() }}</span>
                @if ($appointments->hasMorePages())
                    <a href="{{ $appointments->nextPageUrl() }}">Siguiente</a>
                @else
                    <span class="pagination-disabled" aria-disabled="true">Siguiente</span>
                @endif
            </nav>
        @endif
    </section>
</x-layout.admin>
