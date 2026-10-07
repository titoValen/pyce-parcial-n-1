<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table("categorias")]
/**
 * Representa una categoría de publicaciones del blog.
 */
class Category extends Model
{
    /** @var string Clave primaria de la tabla. */
    protected $primaryKey = "id";

    /** @var array<int, string> Atributos que pueden asignarse masivamente. */
    protected $fillable = ["nombre", "slug"];

    /**
     * Obtiene las publicaciones asociadas a la categoría.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            "categoria_post",
            "categoria_id",
            "post_id"
        );
    }
}
