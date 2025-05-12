<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => Role::ADMIN, 'name' => 'Administrador', 'slug' => 'admin'],
            ['id' => Role::TUTOR, 'name' => 'Tutor',         'slug' => 'tutor'],
            ['id' => Role::USER,  'name' => 'Usuario',       'slug' => 'user'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']],      // clave única
                ['id'   => $role['id'],         // valores a insertar/actualizar
                 'name' => $role['name']]
            );
        }
    }
}
