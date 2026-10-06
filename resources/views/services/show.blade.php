<x-layout.app title="Servicios">
    <h1>{{ $service->nombre }}</h1>
    <p>{{ $service->descripcion }}</p>
    @if ($service->precio_base === 0.00)
        <p>Precio: Gratis</p>
    @else
        <p>Precio: ${{ number_format($service->precio_base, 2) }}</p>
    @endif
    <h4>Artistas de Tatuajes:</h4>
    @if ($service->tattooArtists->isEmpty())
        <p>No hay artistas de tatuajes asociados a este servicio.</p>
    @else
        <ul>
            @foreach ($service->tattooArtists as $artist)
                <li>{{ $artist->nombre }}</li>
            @endforeach
        </ul>
    @endif
</x-layout.app>
