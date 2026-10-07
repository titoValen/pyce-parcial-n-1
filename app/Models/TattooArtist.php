<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table("tatuadores")]
/**
 * Representa a un tatuador que ofrece servicios en el estudio.
 */
class TattooArtist extends Model
{
    /** @var string Clave primaria de la tabla. */
    protected $primaryKey = "id";

    /** @var array<int, string> Atributos que pueden asignarse masivamente. */
    protected $fillable = ["nombre", "especialidad", "bio", "foto"];

    /**
     * Obtiene los servicios ofrecidos por el tatuador.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(
            Service::class,
            "servicio_tatuador",
            "tatuador_id",
            "servicio_id"
        );
    }
}
