<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
        // Desactivamos las restricciones de clave externa
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Limpiamos la tabla de usuarios
        User::truncate();
        // Reactivamos las restricciones de clave externa
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Creamos el usuario administrador
        User::create([
            'name' => 'Javier',
            'email' => 'ardijavi87@gmail.com',
            'password' => Hash::make('password'), // Contraseña por defecto, deberías cambiarla después
            'role_id' => Role::ADMIN, // ID del rol administrador
            'slug' => 'javier', // Agregamos el slug
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
