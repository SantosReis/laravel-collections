<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Database\Factories\EngineFactory;
use Database\Factories\CarModelFactory;
use Database\Factories\HeadquarterFactory;
use Database\Factories\CarProductionDateFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        CarModelFactory::times(5)->create();
        HeadquarterFactory::times(5)->create();
        EngineFactory::times(5)->create();
        CarProductionDateFactory::times(5)->create();

    }
}
