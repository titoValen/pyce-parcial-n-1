<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use Illuminate\View\View;

/**
 * Gestiona la página principal del área administrativa.
 */
class DashboardController extends Controller
{
    /**
     * Muestra el panel con el contador de solicitudes pendientes.
     */
    public function index(): View
    {
        return view('admin.dashboard', [
            'pendingAppointmentsCount' => AppointmentRequest::where(
                'estado',
                AppointmentRequest::PENDIENTE,
            )->count(),
        ]);
    }
}
