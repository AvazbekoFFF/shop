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
        $this->makeOwnGood();

        Category::factory()->count(5)->create();
        $goods = Good::factory()->count(20)->create();
        foreach ($goods as $good) {
            Stock::factory()->count(3)->create(['good_id' => $good->id]);
            Characteristic::factory()->count(3)->create(['good_id' => $good->id]);
        }
    }
    private function makeOwnGood(): void
    {
        $category = Category::factory()->create(['id' => 1091]);
        $good = Good::factory()->create(['category_id' => $category->id, 'prices' => [
                'old' => 100,
                'price' => 250
            ]]
        );
        Stock::factory()->create(['id' => 2, 'good_id' => $good->id]);
        Characteristic::factory()->create([
            'good_id' => $good->id,
            'name' => 'Производитель',
            'value' => 'Китай'
        ]);
    }
}
