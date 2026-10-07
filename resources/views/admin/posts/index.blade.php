<x-layout.admin title="Posts">
    <section class="admin-page" aria-labelledby="posts-title">
        <div class="admin-page-heading">
            <div>
                <p class="eyebrow">Administración / Contenido</p>
                <h1 id="posts-title">Posts</h1>
                <p>Gestiona publicaciones, borradores y sus categorías.</p>
            </div>
            <a class="button button-primary" href="{{ route('admin.posts.create') }}">Crear post</a>
        </div>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Categorías</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->titulo }}</th>
                            <td>
                                <span class="admin-status {{ $post->publicado ? 'is-published' : 'is-draft' }}">
                                    {{ $post->publicado ? 'Publicado' : 'Borrador' }}
                                </span>
                            </td>
                            <td>
                                @if ($post->categories->isNotEmpty())
                                    {{ $post->categories->pluck('nombre')->join(', ') }}
                                @else
                                    <span class="admin-muted">Sin categorías</span>
                                @endif
                            </td>
                            <td>{{ $post->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="admin-row-actions">
                                    <a class="text-link" href="{{ route('admin.posts.edit', $post) }}">Editar</a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro que quieres eliminar este post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="admin-delete-button" type="submit">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="admin-empty" colspan="5">Todavía no hay posts. Puedes crear el primero.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($posts->hasPages())
            <nav class="pagination" aria-label="Paginación de posts">
                @if ($posts->onFirstPage())
                    <span class="pagination-disabled" aria-disabled="true">Anterior</span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}">Anterior</a>
                @endif
                <span class="pagination-status">Página {{ $posts->currentPage() }} de {{ $posts->lastPage() }}</span>
                @if ($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}">Siguiente</a>
                @else
                    <span class="pagination-disabled" aria-disabled="true">Siguiente</span>
                @endif
            </nav>
        @endif
    </section>
</x-layout.admin>
