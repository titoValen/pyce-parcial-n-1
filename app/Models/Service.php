<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

#[Table("servicios")]
class Service extends Model
{
    protected $primaryKey = "id";
    protected $fillable = ["nombre", "descripcion","precio_base", "duracion_estimada", "estilo", "imagen", "activo"];
    protected $casts = [
        "activo" => "boolean",
        "precio_base" => "decimal:2",
    ];

    public function appointmentRequests()
    {
        return $this->hasMany(AppointmentRequest::class, "servicio_id");
    }

    public function tattooArtists()
    {
        return $this->belongsToMany(
            TattooArtist::class,
            "servicio_tatuador",
            "servicio_id",
            "tatuador_id"
        );
    }

    public function getPrecioFormateadoAttribute(): string
    {
        return (float) $this->precio_base <= 0
            ? 'Sin cargo'
            : '$' . number_format((float) $this->precio_base, 0, ',', '.');
    }

    public function getDuracionLegibleAttribute(): string
    {
        $duration = Carbon::parse($this->duracion_estimada);

        return $duration->format('G\h i\m');
    }
}
