<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\ApiTrait;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ApiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'tutor_id',
        'slug',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relacion muchos a uno
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relacion uno a muchos
    // Un usuario puede tener muchos anuncios
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function tutor()
{
    return $this->belongsTo(User::class, 'tutor_id');
}

public function alumnos()
{
    return $this->hasMany(User::class, 'tutor_id');
}

}
