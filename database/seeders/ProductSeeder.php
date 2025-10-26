<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are some users to associate products with
        if (User::count() === 0) {
            User::factory(10)->create();
        }

        $users = User::all();

        // Create products and assign a random existing user to each
        Product::factory()->count(50)->make()->each(function (Product $product) use ($users) {
            $product->user_id = $users->random()->id;
            $product->save();
        });
    }
}
