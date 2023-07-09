<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'NIS' => fake()->randomNumber(8),
            'nmSiswa' => fake()->name(),
            'nmPanggil' => fake()->firstName(),
            'tinggi' => fake()->randomNumber(3),
            'berat' => fake()->randomNumber(3),
            'created_at' => fake()->dateTimeBetween('2024-05-01', '2024-06-31'),
            'updated_at' => fake()->dateTimeBetween('2024-05-01', '2024-06-31'),
        ];
    }
}
