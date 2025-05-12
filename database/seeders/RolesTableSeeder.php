<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Desactiva temporalmente las FK para poder truncar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2) Define los roles
        $roles = [
            ['id'   => Role::ADMIN, 'name' => 'Administrador', 'slug' => 'admin'],
            ['id'   => Role::TUTOR, 'name' => 'Tutor',         'slug' => 'tutor'],
            ['id'   => Role::USER,  'name' => 'Usuario',       'slug' => 'user'],
        ];

        // 3) Insértalos
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
