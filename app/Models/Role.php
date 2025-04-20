<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ApiTrait;


class Role extends Model
{
    use HasFactory, ApiTrait;

    const ADMIN = 1;
    const TUTOR = 2;
    const USER = 3;

 // Relacion muchos a uno
 // Un rol puede tener muchos usuarios
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
