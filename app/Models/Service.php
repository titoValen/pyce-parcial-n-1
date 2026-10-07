<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

#[Table("servicios")]
/**
 * Representa un servicio ofrecido por el estudio.
 */
class Service extends Model
{
    /** @var string Clave primaria de la tabla. */
    protected $primaryKey = "id";

    /** @var array<int, string> Atributos que pueden asignarse masivamente. */
    protected $fillable = ["nombre", "descripcion","precio_base", "duracion_estimada", "estilo", "imagen", "activo"];

    /** @var array<string, string> Conversión de atributos del modelo. */
    protected $casts = [
        "activo" => "boolean",
        "precio_base" => "decimal:2",
    ];

    /**
     * Obtiene las solicitudes de turno del servicio.
     */
    public function appointmentRequests(): HasMany
    {
        return $this->hasMany(AppointmentRequest::class, "servicio_id");
    }

    /**
     * Obtiene los tatuadores asociados al servicio.
     */
    public function tattooArtists(): BelongsToMany
    {
        return $this->belongsToMany(
            TattooArtist::class,
            "servicio_tatuador",
            "servicio_id",
            "tatuador_id"
        );
    }

    /**
     * Devuelve el precio con formato local o la etiqueta para servicios gratuitos.
     */
    public function getPrecioFormateadoAttribute(): string
    {
        return (float) $this->precio_base <= 0
            ? 'Sin cargo'
            : '$' . number_format((float) $this->precio_base, 0, ',', '.');
    }

    /**
     * Devuelve la duración en un formato legible.
     */
    public function getDuracionLegibleAttribute(): string
    {
        $duration = Carbon::parse($this->duracion_estimada);

        return $duration->format('G\h i\m');
    }
}
