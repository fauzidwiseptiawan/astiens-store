<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 sample categories
        for ($i = 1; $i <= 10; $i++) {
            Category::create([
                'name' => $faker->words(2, true), // Random 2-word name
                'slug' => $faker->slug(),         // Slug version
                'position_order' => $i,           // Position in order
                'meta' => $faker->sentence(),     // Meta information
                'meta_desc' => $faker->paragraph(), // Meta description
            ]);
        }
    }
}
