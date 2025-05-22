<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetails>
 */
class UserDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'full_name' => $this->faker->name . $this->faker->name,
            'avatar' => 'avatars/' . $this->faker->uuid . '.jpg',
            'is_banned' => $this->faker->boolean(10),
        ];
    }
}
