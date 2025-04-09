<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Announcement;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array

    {
        $title = $this->faker->unique()->word(50);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->text(2000),
            'urgent' => $this->faker->boolean(50),
            'user_id'=>User::all()->random()->id,
            'category_id'=>Category::all()->random()->id,
            
        ];
    }
}
