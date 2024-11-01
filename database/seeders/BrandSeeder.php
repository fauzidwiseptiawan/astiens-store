<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Buat 10 data brand secara acak
        for ($i = 0; $i < 1000; $i++) {
            $name = $faker->words(5, true);

            Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
