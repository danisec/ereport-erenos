<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'NIP' => fake()->randomNumber(8),
            'namaGuru' => fake()->name(),
            'created_at' => fake()->dateTimeBetween('2024-05-01', '2024-06-31'),
            'updated_at' => fake()->dateTimeBetween('2024-05-01', '2024-06-31'),
        ];
    }
}
