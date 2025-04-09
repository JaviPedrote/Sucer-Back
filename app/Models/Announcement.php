<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

     // Relacion muchos a uno
     public function category()
     {
         return $this->belongsTo(Category::class);
     }

     public function user()
     {
         return $this->belongsTo(User::class);
     }

}

