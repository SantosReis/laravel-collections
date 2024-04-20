<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Database\Factories\EngineFactory;
use Database\Factories\CarModelFactory;
use Database\Factories\HeadquarterFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Brand::factory()->count(5)->create();
        // CarFactory::times(5)->create();
        CarModelFactory::times(5)->create();
        HeadquarterFactory::times(5)->create();
        EngineFactory::times(5)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
