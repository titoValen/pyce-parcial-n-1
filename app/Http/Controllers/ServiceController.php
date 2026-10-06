<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Muestra la lista de servicios que están activos y sus artistas de tatuajes asociados.
     * @return View
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
     * Muestra los detalles de un servicio específico que está activo y sus artistas de tatuajes asociados.
     * @param int $id
     * @return View
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
