<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table("solicitudes_turno")]
class AppointmentRequest extends Model
{
    protected $primaryKey = "id";
    protected $fillable = ["nombre", "email","telefono", "fecha_tentativa", "mensaje", "estado", "servicio_id"];
    protected $casts = [
        "estado" => "boolean",
        "fecha_tentativa" => "datetime"
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, "servicio_id", 'id');
    }
}
