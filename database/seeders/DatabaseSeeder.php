<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\OAuthClientsSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        // Role::create([
        //     'name' => Role::ADMIN,
        //     'slug' => 'admin'
        // ]);
        // Role::create([
        //     'name' => Role::TUTOR,
        //     'slug' => 'tutor'
        // ]);
        // Role::create([
        //     'name' => Role::USER,
        //     'slug' => 'user'
        // ]);
        // Category::factory(4)->create();

        $this->call(RolesTableSeeder::class);

        $this->call([UserSeeder::class]);

        // Comentado temporalmente para evitar errores con las tablas de OAuth
        // $this->call(OAuthClientsSeeder::class);
        // $this->call([AnnouncementSeeder::class]);
    }
}
