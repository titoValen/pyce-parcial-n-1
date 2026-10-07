<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest as Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    /**
     * Lista las solicitudes más recientes y filtra por un estado permitido.
     */
    public function index(Request $request): View
    {
        $states = $this->states();
        $filter = $request->query('estado');
        $filter = in_array($filter, $states, true) ? $filter : null;

        $appointments = Appointment::with('service')
            ->when($filter, fn ($query) => $query->where('estado', $filter))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.appointments.index', [
            'appointments' => $appointments,
            'filter' => $filter,
            'stateLabels' => $this->stateLabels(),
            'filterLabels' => [
                Appointment::PENDIENTE => 'Pendientes',
                Appointment::CONFIRMADO => 'Confirmadas',
                Appointment::CANCELADO => 'Canceladas',
            ],
        ]);
    }

    /**
     * Muestra los datos de contacto, mensaje y servicio de una solicitud.
     */
    public function show(Appointment $appointment): View
    {
        $appointment->load('service');

        return view('admin.appointments.show', [
            'appointment' => $appointment,
            'stateLabels' => $this->stateLabels(),
        ]);
    }

    /**
     * Actualiza únicamente el estado validado de la solicitud.
     */
    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validate([
            'estado' => ['required', Rule::in($this->states())],
        ], [
            'estado.required' => 'Debes seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        $appointment->update(['estado' => $validated['estado']]);

        return redirect()
            ->back()
            ->with('success', 'Estado actualizado correctamente.');
    }

    /**
     * Elimina una solicitud de turno.
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Solicitud eliminada correctamente.');
    }

    /**
     * Devuelve los estados admitidos por el flujo de solicitudes.
     *
     * @return array<int, string>
     */
    private function states(): array
    {
        return [
            Appointment::PENDIENTE,
            Appointment::CONFIRMADO,
            Appointment::CANCELADO,
        ];
    }

    /**
     * Etiquetas visibles de los estados admitidos.
     *
     * @return array<string, string>
     */
    private function stateLabels(): array
    {
        return [
            Appointment::PENDIENTE => 'Pendiente',
            Appointment::CONFIRMADO => 'Confirmado',
            Appointment::CANCELADO => 'Cancelado',
        ];
    }
}
