<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('Eventos1234!');

        // 1. Crear Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => $password,
            'role_id' => Role::ADMIN,
            'slug' => Str::slug('Administrador'),
            'email_verified_at' => now(),
        ]);

        // 2. Crear 10 Tutores
        $tutorIds = [];
        for ($i = 1; $i <= 10; $i++) {
            $tutor = User::create([
                'name' => "Tutor $i",
                'email' => "tutor$i@gmail.com",
                'password' => $password,
                'role_id' => Role::TUTOR,
                'slug' => Str::slug("Tutor $i"),
                'email_verified_at' => now(),
            ]);
            $tutorIds[] = $tutor->id;
        }

        // 3. Crear 200 Alumnos (asignados aleatoriamente a tutores)
        for ($i = 1; $i <= 200; $i++) {
            User::create([
                'name' => "Alumno $i",
                'email' => "alumno$i@gmail.com",
                'password' => $password,
                'role_id' => Role::USER,
                'tutor_id' => $tutorIds[array_rand($tutorIds)],
                'slug' => Str::slug("Alumno $i"),
                'email_verified_at' => now(),
            ]);
        }
    }
}
