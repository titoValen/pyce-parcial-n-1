<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\TattooArtist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Muestra todos los servicios, incluidos los inactivos, y sus artistas.
     */
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::with('tattooArtists')->latest()->paginate(10),
        ]);
    }

    /**
     * Muestra el formulario para crear un servicio.
     */
    public function create(): View
    {
        return view('admin.services.create', [
            'service' => new Service(),
            'tattooArtists' => TattooArtist::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Valida y almacena un servicio y sus artistas asociados.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->validationRules(), $this->validationMessages());
        $artistIds = $validated['tattoo_artists'] ?? [];
        unset($validated['tattoo_artists']);
        $validated['duracion_estimada'] .= ':00';
        $validated['activo'] = $request->boolean('activo');

        $service = Service::create($validated);
        $service->tattooArtists()->sync($artistIds);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Servicio creado correctamente.');
    }

    /**
     * Muestra el formulario de edición con los artistas relacionados.
     */
    public function edit(Service $service): View
    {
        $service->load('tattooArtists');

        return view('admin.services.edit', [
            'service' => $service,
            'tattooArtists' => TattooArtist::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Valida y actualiza un servicio y sincroniza sus artistas asociados.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate($this->validationRules(), $this->validationMessages());
        $artistIds = $validated['tattoo_artists'] ?? [];
        unset($validated['tattoo_artists']);
        $validated['duracion_estimada'] .= ':00';
        $validated['activo'] = $request->boolean('activo');

        $service->update($validated);
        $service->tattooArtists()->sync($artistIds);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    /**
     * Elimina el servicio solo si no tiene solicitudes de turno asociadas.
     */
    public function destroy(Service $service): RedirectResponse
    {
        if ($service->appointmentRequests()->exists()) {
            return redirect()
                ->route('admin.services.index')
                ->with('error', 'No se puede eliminar: tiene solicitudes asociadas. Puedes desactivarlo.');
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }

    /**
     * Reglas de validación para los datos editables del servicio.
     *
     * @return array<string, array<int, string>>
     */
    private function validationRules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'precio_base' => ['required', 'numeric', 'min:0'],
            'duracion_estimada' => ['required', 'date_format:H:i'],
            'estilo' => ['required', 'string', 'max:255'],
            'tattoo_artists' => ['sometimes', 'array'],
            'tattoo_artists.*' => ['integer', 'exists:tatuadores,id'],
        ];
    }

    /**
     * Mensajes de validación en español.
     *
     * @return array<string, string>
     */
    private function validationMessages(): array
    {
        return [
            'nombre.required' => 'El nombre del servicio es obligatorio.',
            'nombre.string' => 'El nombre del servicio debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los :max caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'precio_base.required' => 'El precio base es obligatorio.',
            'precio_base.numeric' => 'El precio base debe ser un número.',
            'precio_base.min' => 'El precio base no puede ser negativo.',
            'duracion_estimada.required' => 'La duración estimada es obligatoria.',
            'duracion_estimada.date_format' => 'La duración debe tener el formato horas:minutos.',
            'estilo.required' => 'El estilo es obligatorio.',
            'estilo.string' => 'El estilo debe ser texto.',
            'estilo.max' => 'El estilo no puede superar los :max caracteres.',
            'tattoo_artists.array' => 'Los tatuadores seleccionados no son válidos.',
            'tattoo_artists.*.integer' => 'Uno de los tatuadores seleccionados no es válido.',
            'tattoo_artists.*.exists' => 'Uno de los tatuadores seleccionados no existe.',
        ];
    }
}
