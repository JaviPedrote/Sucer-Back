<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ApiTrait;


class Announcement extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = [
        'title',
        'slug',
        'urgent',
        'content',
        'user_id',
        'category_id'
    ];
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

