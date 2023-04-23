<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TahunAjaran>
 */
class TahunAjaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tahun_ajaran' => '20' . fake()->numberBetween(20, 22) . '-' . '20' . fake()->numberBetween(21, 23),
            'semester' => fake()->randomElement(['Gasal', 'Genap'])
        ];
    }
}
