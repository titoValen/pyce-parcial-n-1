<form class="admin-post-form" action="{{ $formAction }}" method="POST">
    @csrf
    @if ($formMethod !== 'POST')
        @method($formMethod)
    @endif

    @if ($errors->any())
        <div class="admin-validation-summary" role="alert">
            <p>Revisa los campos marcados e intenta nuevamente.</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-form-field">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $service->nombre) }}"
            maxlength="255" required>
        @error('nombre')<span class="admin-field-error">{{ $message }}</span>@enderror
    </div>

    <div class="admin-form-field">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="6" required>{{ old('descripcion', $service->descripcion) }}</textarea>
        @error('descripcion')<span class="admin-field-error">{{ $message }}</span>@enderror
    </div>

    <div class="admin-form-field">
        <label for="precio_base">Precio base</label>
        <input type="number" id="precio_base" name="precio_base" value="{{ old('precio_base', $service->precio_base) }}"
            min="0" step="0.01" required>
        @error('precio_base')<span class="admin-field-error">{{ $message }}</span>@enderror
    </div>

    <div class="admin-form-field">
        <label for="duracion_estimada">Duración estimada</label>
        <input type="time" id="duracion_estimada" name="duracion_estimada"
            value="{{ substr((string) old('duracion_estimada', $service->duracion_estimada), 0, 5) }}"
            step="60" required>
        @error('duracion_estimada')<span class="admin-field-error">{{ $message }}</span>@enderror
    </div>

    <div class="admin-form-field">
        <label for="estilo">Estilo</label>
        <input type="text" id="estilo" name="estilo" value="{{ old('estilo', $service->estilo) }}"
            maxlength="255" required>
        @error('estilo')<span class="admin-field-error">{{ $message }}</span>@enderror
    </div>

    <fieldset class="admin-form-field admin-category-field">
        <legend>Tatuadores</legend>
        @php
            $selectedArtists = old(
                'tattoo_artists',
                $errors->any() ? [] : ($service->exists ? $service->tattooArtists->modelKeys() : []),
            );
        @endphp
        @forelse ($tattooArtists as $artist)
            <label class="admin-checkbox">
                <input type="checkbox" name="tattoo_artists[]" value="{{ $artist->id }}"
                    @checked(in_array($artist->id, $selectedArtists))>
                <span>{{ $artist->nombre }} — {{ $artist->especialidad }}</span>
            </label>
        @empty
            <p class="admin-muted">Todavía no hay tatuadores disponibles.</p>
        @endforelse
        @error('tattoo_artists')<span class="admin-field-error">{{ $message }}</span>@enderror
        @error('tattoo_artists.*')<span class="admin-field-error">{{ $message }}</span>@enderror
    </fieldset>

    <input type="hidden" name="activo" value="0">
    <label class="admin-checkbox admin-published-checkbox">
        <input type="checkbox" name="activo" value="1" @checked(old('activo', $service->activo))>
        <span>Servicio activo</span>
    </label>

    <div class="admin-form-actions">
        <button class="button button-primary" type="submit">
            {{ $formMethod === 'POST' ? 'Crear servicio' : 'Guardar cambios' }}
        </button>
        <a class="text-link" href="{{ route('admin.services.index') }}">Cancelar</a>
    </div>
</form>
