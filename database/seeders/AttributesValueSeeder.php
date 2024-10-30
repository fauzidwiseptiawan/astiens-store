<?php

namespace Database\Seeders;

use App\Models\AttributesValue;
use App\Models\Attributes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AttributesValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua kategori dan buat subkategori untuk setiap kategori
        $attributes = Attributes::all();

        foreach ($attributes as $attributes) {
            // Buat 3 subkategori per kategori
            for ($i = 0; $i < 10; $i++) {
                $name = $faker->words(2, true); // Contoh nama subkategori
                AttributesValue::create([
                    'name' => ucfirst($name),
                    'attributes_id' => $attributes->id,
                ]);
            }
        }
    }
}
