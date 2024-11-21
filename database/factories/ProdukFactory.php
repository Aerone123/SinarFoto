<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'nama_produk' => fake()->word(), // Nama produk berupa kata acak
                'harga' => fake()->numberBetween(5000, 50000), // Harga antara 5.000 - 50.000
                'stok' => fake()->numberBetween(1, 100), // Stok antara 1 - 100
        ];
    }
}
