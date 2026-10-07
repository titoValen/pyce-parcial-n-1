<x-layout.app :title="isset($category) ? $category->nombre : 'Blog'">
    <section class="page-intro">
        <p class="eyebrow">Old Ink School / Publicaciones</p>
        <h1>{{ isset($category) ? $category->nombre : 'Blog' }}</h1>
        <p>Notas, ideas y publicaciones del estudio.</p>
    </section>

    <section class="post-grid blog-grid" aria-label="Publicaciones">
        @forelse ($posts as $post)
            <article class="post-card">
                <a class="post-card-media" href="{{ route('blog.show', $post->slug) }}"
                    aria-label="Leer {{ $post->titulo }}">
                    @if ($post->imagen)
                        @php
                            $postImage = \Illuminate\Support\Str::startsWith($post->imagen, [
                                'http://',
                                'https://',
                                '/',
                            ])
                                ? $post->imagen
                                : \Illuminate\Support\Facades\Storage::url($post->imagen);
                        @endphp
                        <img src="{{ $postImage }}" alt="{{ $post->titulo }}">
                    @else
                        <span class="post-artwork" aria-hidden="true"><span>Old
                                Ink</span><b>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</b></span>
                    @endif
                </a>
                <div class="post-card-body">
                    <p class="eyebrow">{{ $post->created_at->format('d/m/Y') }}</p>
                    <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->titulo }}</a></h2>
                    <p class="card-copy">{{ $post->extracto }}</p>
                    @if ($post->categories->isNotEmpty())
                        <div class="category-list" aria-label="Categorías">
                            @foreach ($post->categories as $postCategory)
                                <a
                                    href="{{ route('blog.category', $postCategory->slug) }}">{{ $postCategory->nombre }}</a>
                            @endforeach
                        </div>
                    @endif
                    <a class="text-link" href="{{ route('blog.show', $post->id) }}">Leer artículo <span
                            aria-hidden="true">-&gt;</span></a>
                </div>
            </article>
        @empty
            <p class="empty-state">No hay publicaciones en esta sección todavía.</p>
        @endforelse
    </section>

    @if ($posts->hasPages())
        <nav class="pagination" aria-label="Paginación del blog">
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
</x-layout.app>
