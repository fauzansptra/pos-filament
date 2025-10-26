<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'sku' => strtoupper(fake()->bothify('???-#####')),
            'price_cents' => (int) round(fake()->randomFloat(2, 1, 1000) * 100),
            'cost_cents' => (int) round(fake()->randomFloat(2, 0.5, 800) * 100),
            'stock' => fake()->numberBetween(0, 500),
            'description' => fake()->optional()->paragraph(),
            'is_active' => fake()->boolean(85),
            // associate in seeder so we can reuse existing users
            'user_id' => null,
        ];
    }
}
