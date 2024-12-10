<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Dynamically create a related user
            'type' => $this->faker->sentence(1),
            'file_name' => $this->faker->text(10),
            'message' => $this->faker->text(50),
            'is_read' => $this->faker->boolean(20), // 20% chance of being read
            'report_id' => 1,
            'report_type' => '3x',
        ];
    }
}
