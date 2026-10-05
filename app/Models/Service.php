<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table("servicios")]
class Service extends Model
{
    protected $primaryKey = "id";
    protected $fillable = ["nombre", "descripcion","precio_base", "duracion_estimada", "estilo", "imagen", "activo"];
    protected $casts = [
        "activo" => "boolean",
        "precio_base" => "decimal:2",
    ];

    public function tattoArtists()
    {
        return $this->belongsToMany(
            TattooArtist::class,
            "servicio_tatuador",
            "servicio_id",
            "tatuador_id"
        );
    }
}
