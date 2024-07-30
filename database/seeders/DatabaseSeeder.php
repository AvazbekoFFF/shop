<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Good;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->count(5)->create();
        Good::factory()->count(10)->create();
        Stock::factory()->count(5)->create();
        Characteristic::factory()->count(5)->create();
    }
}
