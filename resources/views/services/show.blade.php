<x-layout.app :title="$service->nombre">
    <article class="detail-page">
        <a class="back-link" href="{{ route('services.index') }}">&lt;- Todos los servicios</a>
        @if ($service->imagen)
            @php
                $serviceImage = \Illuminate\Support\Str::startsWith($service->imagen, ['http://', 'https://', '/'])
                    ? $service->imagen
                    : \Illuminate\Support\Facades\Storage::url($service->imagen);
            @endphp
            <figure class="article-image service-detail-image"><img src="{{ $serviceImage }}" alt="{{ $service->nombre }}">
            </figure>
        @endif
        <div class="detail-layout">
            <div class="detail-copy">
                <p class="eyebrow">{{ $service->estilo ?: 'Servicio de tatuaje' }}</p>
                <h1>{{ $service->nombre }}</h1>
                <p class="detail-description">{{ $service->descripcion }}</p>
                <dl class="service-facts">
                    <div>
                        <dt>Precio base</dt>
                        <dd>{{ (float) $service->precio_base <= 0 ? 'Sin cargo' : '$' . number_format((float) $service->precio_base, 0, ',', '.') }}
                        </dd>
                    </div>
                    <div>
                        <dt>Duración estimada</dt>
                        <dd>{{ \Illuminate\Support\Carbon::parse($service->duracion_estimada)->format('G\h i\m') }}</dd>
                    </div>
                </dl>
            </div>
            <aside class="detail-aside">
                <p class="eyebrow">Equipo</p>
                <h2>Artistas</h2>
                @if ($service->tattooArtists->isEmpty())
                    <p class="muted-copy">No hay artistas asociados a este servicio todavía.</p>
                @else
                    <ul class="artist-list">
                        @foreach ($service->tattooArtists as $artist)
                            <li>{{ $artist->nombre }}<span>{{ $artist->especialidad }}</span></li>
                        @endforeach
                    </ul>
                @endif
                <a class="button button-outline" href="{{ route('services.index') }}">Ver otros servicios</a>
            </aside>
        </div>
    </article>
</x-layout.app>
