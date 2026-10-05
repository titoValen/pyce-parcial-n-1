<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table("tatuadores")]
class TattooArtist extends Model
{
    protected $primaryKey = "id";
    protected $fillable = ["nombre", "especialidad", "bio", "foto"];

    public function services()
    {
        return $this->belongsToMany(
            Service::class,
            "servicio_tatuador",
            "tatuador_id",
            "servicio_id"
        );
    }
}
