<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Desactivar temporalmente comprobación de FKs
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // 2) Vaciar la tabla roles
        DB::table('roles')->truncate();
        // 3) Volver a activar FKs
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 4) Definir los roles fijos
        $roles = [
            ['id' => Role::ADMIN, 'name' => 'Administrador', 'slug' => 'admin'],
            ['id' => Role::TUTOR,     'name' => 'Tutor',         'slug' => 'tutor'],
            ['id' => Role::USER,      'name' => 'Usuario',       'slug' => 'user'],
        ];

        // 5) Insertarlos
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
