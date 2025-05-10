<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ApiTrait;


class Announcement extends Model
{
    use HasFactory, ApiTrait;

     // Valores por defecto para atributos
     protected $attributes = [
        'urgent' => false,
    ];

    // Para que siempre tariga al usuario
    protected $with = ['user'];

    // Para que siempre lo maneje como booleano
    protected $casts = [
        'urgent' => 'boolean',
    ];

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
         return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
