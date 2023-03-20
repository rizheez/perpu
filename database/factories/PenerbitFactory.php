<?php

namespace Database\Factories;

use App\Models\Penerbit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penerbit>
 */
class PenerbitFactory extends Factory
{
    protected $model = Penerbit::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->company(),
        ];
    }
}
