<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[Table("usuarios")]
class User extends Authenticatable
{
    protected $primaryKey = "id";
    protected $fillable = ["nombre", "email","password"];

    public function posts()
    {
        return $this->hasMany(Post::class, "usuario_id");
    }
}
