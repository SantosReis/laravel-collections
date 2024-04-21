<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarProduct>
 */
class CarProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => function () {
                return Brand::all()->random()->id;
                // return Brand::factory()->create()->id;
            },
            'product_id' => function () {
                return Product::all()->random()->id;
                // return Product::factory()->create()->id;
            },
        ];
    }
}
