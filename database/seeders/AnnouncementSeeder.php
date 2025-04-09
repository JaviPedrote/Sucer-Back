<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Announcement::factory(30)->create()->each(function (Announcement $announcement) {
            $announcement->category_id = rand(1, 4);
            $announcement->user_id = rand(1, 10);
        });
    }
}
