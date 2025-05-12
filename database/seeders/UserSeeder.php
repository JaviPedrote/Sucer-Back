<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ardijavi87@gmail.com'],   // criterio único
            [
                'name'     => 'Javier',
                'role_id'  => Role::ADMIN,
                'password' => bcrypt('password'),
                'slug'     => Str::slug('Javier'),
            ]
        );
    }
}
