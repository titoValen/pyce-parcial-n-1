<x-layout.app title="Agendar cita">
    <section class="page-intro">
        <p class="eyebrow">Old Ink School / Estudio</p>
        <h1>Agendar cita</h1>
        <p>Selecciona el servicio que deseas agendar y completa el formulario para reservar tu cita.</p>
    </section>

    <section class="appointment-form" aria-label="Formulario de agendamiento de cita">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="servicio_id">Servicio</label>
                <select name="servicio_id" id="servicio_id" required>
                    <option value="">Selecciona un servicio</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" @selected(old('servicio_id') == $service->id)>
                            {{ $service->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_tentativa">Fecha y hora</label>
                <input type="datetime-local" name="fecha_tentativa" id="fecha_tentativa"
                    value="{{ old('fecha_tentativa') }}" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" id="telefono" value="{{ old('telefono') }}" required>
            </div>

            <div class="form-group">
                <label for="mensaje">Mensaje (opcional)</label>
                <textarea name="mensaje" id="mensaje">{{ old('mensaje') }}</textarea>
            </div>

            <button type="submit">Agendar cita</button>
        </form>
    </section>

</x-layout.app>
