<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table("usuario")]
class User extends Model
{
    protected $primaryKey = "id";
    protected $fillable = ["nombre", "email","password"];
}
