<x-layout.app title="Inicio">
    <h1>Hola mundo</h1>

    @forelse ($services as $service)
        <article>
            <h3>{{ $service->nombre }}</h3>
            <p>{{ $service->descripcion }}</p>
        </article>
    @empty
        <p>No hay servicios disponibles.</p>
    @endforelse

    <h2>Últimos posts</h2>
    @forelse ($posts as $post)
        <article>
            <h3>{{ $post->titulo }}</h3>
            <p>{{ $post->resumen }}</p>
        </article>
    @empty
        <p>No hay posts disponibles.</p>
    @endforelse
</x-layout.app>
