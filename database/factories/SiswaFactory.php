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
            'nis' => fake()->randomNumber(8),
            'nama_siswa' => fake()->name(),
            'nama_panggilan' => fake()->firstName(),
            'tinggi_badan' => fake()->randomNumber(3),
            'berat_badan' => fake()->randomNumber(3),
        ];
    }
}
