<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table("usuarios")]
/**
 * Representa una cuenta de usuario del área de administración.
 */
class User extends Authenticatable
{
    use HasFactory;

    /** @var string Clave primaria de la tabla. */
    protected $primaryKey = "id";

    /** @var array<int, string> Atributos que pueden asignarse masivamente. */
    protected $fillable = ["nombre", "email","password"];

    /**
     * Obtiene las publicaciones creadas por el usuario.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, "usuario_id");
    }
}
