<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

/**
 * Presenta los servicios disponibles para los visitantes.
 */
class ServiceController extends Controller
{
    /**
     * Muestra los servicios activos y sus tatuadores asociados.
     */
    public function index(): View
    {
        $services = Service::where('activo', true)
            ->with('tattooArtists')
            ->get();

        return view('services.index', [
            'services' => $services,
        ]);
    }

    /**
     * Muestra un servicio activo y sus tatuadores asociados.
     *
     * @param int $id Identificador del servicio.
     */
    public function show(int $id): View
    {
        $service = Service::where('activo', true)
            ->with('tattooArtists')
            ->findOrFail($id);

        return view('services.show', [
            'service' => $service,
        ]);
    }
}
