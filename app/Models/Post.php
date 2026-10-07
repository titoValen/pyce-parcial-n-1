<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table("posts")]
/**
 * Representa una publicación del blog.
 */
class Post extends Model
{
    /** @var string Clave primaria de la tabla. */
    protected $primaryKey = "id";

    /** @var array<int, string> Atributos que pueden asignarse masivamente. */
    protected $fillable = ["titulo", "slug","extracto", "contenido", "imagen", "publicado", "usuario_id"];

    /** @var array<string, string> Conversión de atributos del modelo. */
    protected $casts = [
        "publicado" => "boolean"
    ];

    /**
     * Obtiene el usuario autor de la publicación.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "usuario_id", 'id');
    }

    /**
     * Obtiene las categorías asociadas a la publicación.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            "categoria_post",
            "post_id",
            "categoria_id"
        );
    }
}
