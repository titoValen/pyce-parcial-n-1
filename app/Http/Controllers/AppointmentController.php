<?php

namespace App\Http\Controllers;

use App\Models\AppointmentRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Gestiona las solicitudes de turnos del sitio público.
 */
class AppointmentController extends Controller
{
    /**
     * Muestra el formulario con los servicios disponibles.
     */
    public function create(): View
    {
        $services = Service::where('activo', true)->get();

        return view('appointments.create', [
            'services' => $services,
        ]);
    }

    /**
     * Valida y registra una solicitud de turno.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'fecha_tentativa' => 'required|date|after:today',
            'mensaje' => 'nullable|string|max:255',
        ], [
            'servicio_id.required' => 'Debes seleccionar un servicio.',
            'servicio_id.exists' => 'El servicio seleccionado no es válido.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los :max caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'Ingresa una dirección de correo electrónico válida.',
            'email.max' => 'El correo electrónico no puede superar los :max caracteres.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede superar los :max caracteres.',
            'fecha_tentativa.required' => 'El campo fecha tentativa es obligatorio.',
            'fecha_tentativa.date' => 'Ingresa una fecha y hora válida.',
            'fecha_tentativa.after' => 'La fecha tentativa debe ser posterior a hoy.',
            'mensaje.string' => 'El mensaje debe ser texto.',
            'mensaje.max' => 'El mensaje no puede superar los :max caracteres.',
        ]);

        AppointmentRequest::create([
            ...$validated,
            'estado' => AppointmentRequest::PENDIENTE,
        ]);

        return redirect(url('/'))
            ->with('success', 'Solicitud de cita enviada correctamente. Nos pondremos en contacto contigo pronto.');
    }
}
