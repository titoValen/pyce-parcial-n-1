<x-layout.admin title="Detalle de solicitud">
    <section class="admin-page" aria-labelledby="appointment-title">
        <p class="eyebrow">Administración / Solicitudes</p>
        <h1 id="appointment-title">Solicitud de {{ $appointment->nombre }}</h1>
        <p>
            <span class="appointment-status appointment-status--{{ $appointment->estado }}">
                {{ $stateLabels[$appointment->estado] ?? ucfirst($appointment->estado) }}
            </span>
        </p>

        <dl class="appointment-details">
            <div>
                <dt>Servicio solicitado</dt>
                <dd>{{ $appointment->service?->nombre ?? 'Servicio no disponible' }}</dd>
            </div>
            <div>
                <dt>Fecha tentativa</dt>
                <dd>{{ $appointment->fecha_tentativa->format('d/m/Y H:i') }}</dd>
            </div>
            <div>
                <dt>Fecha de recepción</dt>
                <dd>{{ $appointment->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div>
                <dt>Nombre</dt>
                <dd>{{ $appointment->nombre }}</dd>
            </div>
            <div>
                <dt>Correo electrónico</dt>
                <dd><a href="mailto:{{ $appointment->email }}">{{ $appointment->email }}</a></dd>
            </div>
            <div>
                <dt>Teléfono</dt>
                <dd><a href="tel:{{ $appointment->telefono }}">{{ $appointment->telefono }}</a></dd>
            </div>
            <div class="appointment-message">
                <dt>Mensaje</dt>
                <dd>{{ $appointment->mensaje ?: 'Sin mensaje adicional.' }}</dd>
            </div>
        </dl>

        <form class="appointment-detail-state-form"
            action="{{ route('admin.appointments.update', $appointment) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="estado">Cambiar estado</label>
            <select id="estado" name="estado">
                @foreach ($stateLabels as $state => $label)
                    <option value="{{ $state }}" @selected($appointment->estado === $state)>{{ $label }}</option>
                @endforeach
            </select>
            @error('estado')<span class="admin-field-error">{{ $message }}</span>@enderror
            <button class="button button-primary" type="submit">Actualizar estado</button>
        </form>

        <div class="admin-form-actions appointment-detail-actions">
            <a class="text-link" href="{{ route('admin.appointments.index') }}">Volver a solicitudes</a>
            <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST"
                onsubmit="return confirm('¿Seguro que quieres eliminar esta solicitud?');">
                @csrf
                @method('DELETE')
                <button class="admin-delete-button" type="submit">Eliminar solicitud</button>
            </form>
        </div>
    </section>
</x-layout.admin>
