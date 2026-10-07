<x-layout.app :title="$post->titulo">
    <article class="article-page">
        <a class="back-link" href="{{ route('blog.index') }}">&lt;- Volver al blog</a>
        <header class="article-header">
            <p class="eyebrow">Publicado el {{ $post->created_at->format('d/m/Y') }}</p>
            <h1>{{ $post->titulo }}</h1>
            @if ($post->categories->isNotEmpty())
                <div class="category-list" aria-label="Categorías">
                    @foreach ($post->categories as $category)
                        <a href="{{ route('blog.category', $category->slug) }}">{{ $category->nombre }}</a>
                    @endforeach
                </div>
            @endif
        </header>
        @if ($post->imagen)
            @php
                $postImage = \Illuminate\Support\Str::startsWith($post->imagen, ['http://', 'https://', '/'])
                    ? $post->imagen
                    : \Illuminate\Support\Facades\Storage::url($post->imagen);
            @endphp
            <figure class="article-image"><img src="{{ $postImage }}" alt="{{ $post->titulo }}"></figure>
        @endif
        @if ($post->extracto)
            <p class="article-extract">{{ $post->extracto }}</p>
        @endif
        <div class="article-content">{{ $post->contenido }}</div>
    </article>
</x-layout.app>
