<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role; // Ensure Role is imported from the correct namespace

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Javier',
            'email'=> 'ardijavi87@gmail.com',
            'role_id'  => Role::ADMIN,
            'password' => bcrypt('password'),
            'slug'     => Str::slug('Javier'),
        ]);
    }
}
