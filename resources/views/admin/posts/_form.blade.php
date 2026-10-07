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
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $post->titulo) }}" maxlength="255"
            required>
        @error('titulo')<span class="admin-field-error">{{ $message }}</span>@enderror
    </div>

    <div class="admin-form-field">
        <label for="slug">Slug</label>
        <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" maxlength="255"
            pattern="[A-Za-z0-9_-]+" aria-describedby="slug-help" required>
        <small id="slug-help">Usa letras, números, guiones o guiones bajos; debe ser único.</small>
        @error('slug')<span class="admin-field-error">{{ $message }}</span>@enderror
    </div>

    <div class="admin-form-field">
        <label for="extracto">Extracto</label>
        <textarea id="extracto" name="extracto" rows="3" maxlength="255" required>{{ old('extracto', $post->extracto) }}</textarea>
        @error('extracto')<span class="admin-field-error">{{ $message }}</span>@enderror
    </div>

    <div class="admin-form-field">
        <label for="contenido">Contenido</label>
        <textarea id="contenido" name="contenido" rows="12" required>{{ old('contenido', $post->contenido) }}</textarea>
        @error('contenido')<span class="admin-field-error">{{ $message }}</span>@enderror
    </div>

    <fieldset class="admin-form-field admin-category-field">
        <legend>Categorías</legend>
        @php
            $selectedCategories = old(
                'categories',
                $post->exists ? $post->categories->modelKeys() : [],
            );
        @endphp
        @forelse ($categories as $category)
            <label class="admin-checkbox">
                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                    @checked(in_array($category->id, $selectedCategories))>
                <span>{{ $category->nombre }}</span>
            </label>
        @empty
            <p class="admin-muted">Todavía no hay categorías disponibles.</p>
        @endforelse
        @error('categories')<span class="admin-field-error">{{ $message }}</span>@enderror
        @error('categories.*')<span class="admin-field-error">{{ $message }}</span>@enderror
    </fieldset>

    <label class="admin-checkbox admin-published-checkbox">
        <input type="checkbox" name="publicado" value="1" @checked(old('publicado', $post->publicado))>
        <span>Publicado</span>
    </label>

    <div class="admin-form-actions">
        <button class="button button-primary" type="submit">
            {{ $formMethod === 'POST' ? 'Crear post' : 'Guardar cambios' }}
        </button>
        <a class="text-link" href="{{ route('admin.posts.index') }}">Cancelar</a>
    </div>
</form>
