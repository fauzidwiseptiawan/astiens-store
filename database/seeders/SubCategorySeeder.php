<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua kategori dan buat subkategori untuk setiap kategori
        $categories = Category::all();

        foreach ($categories as $category) {
            // Buat 3 subkategori per kategori
            for ($i = 0; $i < 3; $i++) {
                $name = $faker->words(2, true); // Contoh nama subkategori
                SubCategory::create([
                    'name' => ucfirst($name),
                    'slug' => Str::slug($name),
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
