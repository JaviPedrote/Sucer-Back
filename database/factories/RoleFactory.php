<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rols = [Role::ADMIN, Role::TUTOR, Role::USER];
        $name = $this->faker->randomElement($rols);
            return [
                'name' => $name,
                'slug' => Str::slug($name)
            ];
        }

}
