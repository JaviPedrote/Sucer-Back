<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Vaciamos la tabla sin chequear FKs
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2) Definimos los roles con nombres cortos
        $roles = [
            ['id'   => Role::ADMIN, 'name' => 'Admin',   'slug' => 'admin'],
            ['id'   => Role::TUTOR, 'name' => 'Tutor',   'slug' => 'tutor'],
            ['id'   => Role::USER,  'name' => 'Usuario', 'slug' => 'user'],
        ];

        // 3) Creamos los roles
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
