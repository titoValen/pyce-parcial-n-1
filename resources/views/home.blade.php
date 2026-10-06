<x-layout.app title="Inicio">
    <section class="home-hero">
        <div class="hero-copy">
            <p class="eyebrow">Estudio de tatuajes</p>
            <h1>Old Ink <span>School</span></h1>
            <p class="hero-description">Diseño personalizado y servicios de tatuaje.</p>
            <a class="button button-primary" href="{{ route('services') }}">Explorar servicios <span aria-hidden="true">-&gt;</span></a>
        </div>
        <div class="hero-art" aria-hidden="true">
            <span class="hero-art-kicker">TINTA / DISEÑO</span>
            <span class="hero-art-title">Old<br>Ink</span>
            <span class="hero-art-caption">SCHOOL</span>
        </div>
    </section>

    <section class="content-section" aria-labelledby="services-heading">
        <div class="section-heading">
            <div>
                <p class="eyebrow">El estudio</p>
                <h2 id="services-heading">Servicios</h2>
            </div>
            <a class="text-link" href="{{ route('services') }}">Ver todos <span aria-hidden="true">-&gt;</span></a>
        </div>
        <div class="service-grid">
            @forelse ($services as $service)
                <article class="service-card">
                    @if ($service->imagen)
                        @php
                            $serviceImage = \Illuminate\Support\Str::startsWith($service->imagen, ['http://', 'https://', '/'])
                                ? $service->imagen
                                : \Illuminate\Support\Facades\Storage::url($service->imagen);
                        @endphp
                        <img class="service-card-image" src="{{ $serviceImage }}" alt="{{ $service->nombre }}">
                    @endif
                    <div class="service-card-mark" aria-hidden="true">
                        <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="mark-rule"></span>
                    </div>
                    <p class="eyebrow">{{ $service->estilo ?: 'Servicio de tatuaje' }}</p>
                    <h3>{{ $service->nombre }}</h3>
                    <p class="card-copy">{{ \Illuminate\Support\Str::limit($service->descripcion, 135) }}</p>
                    <a class="text-link" href="{{ route('services.show', $service->id) }}">Ver servicio <span aria-hidden="true">-&gt;</span></a>
                </article>
            @empty
                <p class="empty-state">No hay servicios disponibles por el momento.</p>
            @endforelse
        </div>
    </section>

    <section class="content-section content-section-blog" aria-labelledby="journal-heading">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Lecturas del estudio</p>
                <h2 id="journal-heading">Últimas publicaciones</h2>
            </div>
            <a class="text-link" href="{{ route('blog') }}">Ir al blog <span aria-hidden="true">-&gt;</span></a>
        </div>
        <div class="post-grid">
            @forelse ($posts as $post)
                <article class="post-card">
                    <a class="post-card-media" href="{{ route('blog.show', $post->slug) }}" aria-label="Leer {{ $post->titulo }}">
                        @if ($post->imagen)
                            @php
                                $postImage = \Illuminate\Support\Str::startsWith($post->imagen, ['http://', 'https://', '/'])
                                    ? $post->imagen
                                    : \Illuminate\Support\Facades\Storage::url($post->imagen);
                            @endphp
                            <img src="{{ $postImage }}" alt="{{ $post->titulo }}">
                        @else
                            <span class="post-artwork" aria-hidden="true"><span>Old Ink</span><b>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</b></span>
                        @endif
                    </a>
                    <div class="post-card-body">
                        <p class="eyebrow">{{ $post->created_at->format('d/m/Y') }}</p>
                        <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->titulo }}</a></h3>
                        <p class="card-copy">{{ $post->extracto }}</p>
                        <a class="text-link" href="{{ route('blog.show', $post->slug) }}">Leer artículo <span aria-hidden="true">-&gt;</span></a>
                    </div>
                </article>
            @empty
                <p class="empty-state">Todavía no hay publicaciones.</p>
            @endforelse
        </div>
    </section>
</x-layout.app>
