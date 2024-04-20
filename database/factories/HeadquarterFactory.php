<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Headquarter>
 */
class HeadquarterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'headquarters' => fake()->city(),
            'country' => fake()->country(),
            'brand_id' => function () {
                return Brand::factory()->create()->id;
            },
        ];
    }
}
