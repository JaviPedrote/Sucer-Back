<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // Relacion uno a muchos
    // Una categoria puede tener muchos anuncios
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
