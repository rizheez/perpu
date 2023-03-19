<?php

namespace Database\Factories;

use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\buku>
 */
class BukuFactory extends Factory
{
    protected $model = Buku::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $penulisIds = Penulis::pluck('id');
        $kategoriIds = Kategori::pluck('id');
        return [
            'judul' => $this->faker->sentence(),
            'penulis_id' => $this->faker->randomElement($penulisIds),
            'kategori_id' => $this->faker->randomElement($kategoriIds),
            'penerbit' => $this->faker->company(),
            'tahun_terbit' => $this->faker->numberBetween(1900, 2023),
            'stok' => $this->faker->numberBetween(0, 100),
        ];
    }
}
