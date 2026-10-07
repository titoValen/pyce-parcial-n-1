<?php

namespace Database\Seeders;

use App\Models\AppointmentRequest;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use RuntimeException;

/**
 * Crea solicitudes de turno de ejemplo asociadas a servicios existentes.
 */
class AppointmentRequestSeeder extends Seeder
{
    /**
     * Siembra solicitudes de ejemplo asociadas a servicios por su nombre.
     */
    public function run(): void
    {
        $services = Service::pluck('id', 'nombre');
        $consultationId = $services->get('Consulta y diseño personalizado');
        $smallTattooId = $services->get('Tatuaje pequeño (hasta 8 cm)');
        $mediumTattooId = $services->get('Tatuaje mediano (hasta 20 cm)');

        if (! $consultationId || ! $smallTattooId || ! $mediumTattooId) {
            throw new RuntimeException('Ejecuta ServiceSeeder antes de AppointmentRequestSeeder.');
        }

        $requests = [
            ['nombre' => 'Camila Ríos', 'servicio_id' => $consultationId, 'estado' => AppointmentRequest::PENDIENTE],
            ['nombre' => 'Mateo Silva', 'servicio_id' => $smallTattooId, 'estado' => AppointmentRequest::CONFIRMADO],
            ['nombre' => 'Lucía Torres', 'servicio_id' => $mediumTattooId, 'estado' => AppointmentRequest::CANCELADO],
            ['nombre' => 'Tomás Vega', 'servicio_id' => $smallTattooId, 'estado' => AppointmentRequest::PENDIENTE],
            ['nombre' => 'Sofía Castro', 'servicio_id' => $consultationId, 'estado' => AppointmentRequest::CONFIRMADO],
            ['nombre' => 'Nicolás Paz', 'servicio_id' => $mediumTattooId, 'estado' => AppointmentRequest::PENDIENTE],
        ];

        foreach ($requests as $index => $request) {
            AppointmentRequest::create([
                ...$request,
                'email' => 'cliente' . ($index + 1) . '@example.com',
                'telefono' => '11-5555-' . str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT),
                'fecha_tentativa' => Carbon::now()->addDays($index + 2)->setTime(11 + $index, 0),
                'mensaje' => 'Solicitud de ejemplo para ' . strtolower($request['nombre']) . '.',
            ]);
        }
    }
}
