<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ApiTrait;

class Category extends Model
{
    use HasFactory, ApiTrait;

    // Campos que se pueden asignar masivamente (mass assignment)
    protected $fillable = ['name', 'slug'];

    // Relaciones permitidas para incluir en la consulta via ?included=
    protected $allowIncluded = ['announcements', 'announcements.user'];

    // Campos permitidos para filtrado via ?filter[field]=value
    protected $allowFilter = ['id', 'name', 'slug'];

    // Campos permitidos para ordenación via ?sort=field or ?sort=-field
    protected $allowSort = ['id', 'name', 'slug'];

    /**
     * Relación uno a muchos:
     * Una categoría puede tener muchos anuncios
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

}
