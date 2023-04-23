<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelajaran>
 */
class PelajaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_pelajaran' => fake()->randomNumber(3),
            'nama_pelajaran' => 'Bahasa Indonesia',
            'nama_singkatan' => 'B.Indo',
            'nilai_kkm' => fake()->randomNumber(2),
        ];
    }
}
