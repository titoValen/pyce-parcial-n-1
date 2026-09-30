<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table("categorias")]
class Categorie extends Model
{
    protected $primaryKey = "id";
    protected $fillable = ["nombre", "slug"];

    public function posts()
    {
        return $this->belongsToMany(
            Posts::class,
            "categoria_post",
            "categoria_id",
            "post_id"
        );
    }
}
