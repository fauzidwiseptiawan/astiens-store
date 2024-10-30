<?php

namespace Database\Seeders;

use App\Models\Attributes;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributeNames = [
            'Color',
            'Size',
            'Material',
        ];

        // Generate 10 sample categories
        foreach ($attributeNames as $name) {
            Attributes::create([
                'name' => $name,
            ]);
        }


        // // Generate 10 sample categories
        // for ($i = 1; $i <= 10; $i++) {
        //     Attributes::create([
        //         'name' => $faker->words(2, true), // Random 2-word name
        //     ]);
        // }
    }
}
