<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'name' => ucfirst($name),
            'slug' => \Illuminate\Support\Str::slug($name),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 50, 1500),
            'stock' => fake()->numberBetween(10, 100),
            'image' => 'https://picsum.photos/400/300?random=' . fake()->numberBetween(1, 1000),
        ];
    }
}