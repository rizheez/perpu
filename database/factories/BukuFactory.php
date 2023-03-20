<?php

namespace Database\Factories;

use App\Models\Buku;
use App\Models\Penerbit;
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
        $penerbitIds = Penerbit::pluck('id');
        $kategoriIds = Kategori::pluck('id');
        return [
            'judul' => $this->faker->sentence(),
            'penulis' => $this->faker->name(),
            'kategori_id' => $this->faker->randomElement($kategoriIds),
            'penerbit_id' => $this->faker->randomElement($penerbitIds),
            'tahun_terbit' => $this->faker->numberBetween(2000, 2023),
            'stok' => $this->faker->numberBetween(0, 100),
        ];
    }
}
