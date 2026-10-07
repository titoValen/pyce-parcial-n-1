<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table("solicitudes_turno")]
/**
 * Representa una solicitud de turno enviada por un cliente.
 */
class AppointmentRequest extends Model
{
    /** Estado inicial de una solicitud de turno. */
    public const PENDIENTE = 'pendiente';

    /** Estado de una solicitud de turno aceptada. */
    public const CONFIRMADO = 'confirmado';

    /** Estado de una solicitud de turno rechazada. */
    public const CANCELADO = 'cancelado';

    /** @var string Clave primaria de la tabla. */
    protected $primaryKey = "id";

    /** @var array<int, string> Atributos que pueden asignarse masivamente. */
    protected $fillable = ["nombre", "email","telefono", "fecha_tentativa", "mensaje", "estado", "servicio_id"];

    /** @var array<string, string> Conversión de atributos del modelo. */
    protected $casts = [
        "fecha_tentativa" => "datetime"
    ];

    /**
     * Obtiene el servicio asociado a la solicitud.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, "servicio_id", 'id');
    }
}
