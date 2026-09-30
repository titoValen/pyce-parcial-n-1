<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table("posts")]
class Posts extends Model
{
    protected $primaryKey = "id";
    protected $fillable = ["titulo", "slug","extracto", "contenido", "imagen", "publicado", "usuario_id"];
    protected $casts = [
        "publicado" => "boolean"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "usuario_id", 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(
            Categorie::class,
            "categoria_post",
            "post_id",
            "categoria_id"
        );
    }
}
