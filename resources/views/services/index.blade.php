<x-layout.app title="Servicios">
    <section class="page-intro">
        <p class="eyebrow">Old Ink School / Estudio</p>
        <h1>Servicios</h1>
        <p>Opciones de diseño y tatuaje según el tamaño, el estilo y el tiempo de cada pieza.</p>
    </section>

    <section class="service-list" aria-label="Servicios disponibles">
        @forelse ($services as $service)
            <article class="service-row">
                <div class="service-row-number" aria-hidden="true">
                    {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="service-row-copy">
                    @if ($service->imagen)
                        @php
                            $serviceImage = \Illuminate\Support\Str::startsWith($service->imagen, [
                                'http://',
                                'https://',
                                '/',
                            ])
                                ? $service->imagen
                                : \Illuminate\Support\Facades\Storage::url($service->imagen);
                        @endphp
                        <img class="service-row-image" src="{{ $serviceImage }}" alt="{{ $service->nombre }}">
                    @endif
                    <p class="eyebrow">{{ $service->estilo ?: 'Servicio de tatuaje' }}</p>
                    <h2><a href="{{ route('services.show', $service->id) }}">{{ $service->nombre }}</a></h2>
                    <p>{{ $service->descripcion }}</p>
                </div>
                <div class="service-row-meta">
                    <span class="meta-label">Precio base</span>
                    <strong>{{ (float) $service->precio_base <= 0 ? 'Sin cargo' : '$' . number_format((float) $service->precio_base, 0, ',', '.') }}</strong>
                    <a class="text-link" href="{{ route('services.show', $service->id) }}">Ver detalles <span
                            aria-hidden="true">-&gt;</span></a>
                </div>
            </article>
        @empty
            <p class="empty-state">No hay servicios disponibles por el momento.</p>
        @endforelse
    </section>
</x-layout.app>
