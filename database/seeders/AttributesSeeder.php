<?php

namespace Database\Seeders;

use App\Models\Attributes;
use App\Models\AttributesValue;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            [
                "name" => "Color",
                "values" => ["Red", "Blue", "Green", "Yellow"]
            ],
            [
                "name" => "Size",
                "values" => [
                    // Clothing sizes (S, M, L, XL, XXL)
                    "S",
                    "M",
                    "L",
                    "XL",
                    "XXL",
                    // Shoe sizes (US, EU, UK)
                    "US 6",
                    "US 7",
                    "US 8",
                    "US 9",
                    "US 10",
                    "US 11",
                    "US 12", // US Shoe Sizes
                    "EU 39",
                    "EU 40",
                    "EU 41",
                    "EU 42",
                    "EU 43",
                    "EU 44",
                    "EU 45", // EU Shoe Sizes
                    "UK 5",
                    "UK 6",
                    "UK 7",
                    "UK 8",
                    "UK 9",
                    "UK 10",
                    "UK 11"  // UK Shoe Sizes
                ]
            ],
            [
                "name" => "Material",
                "values" => ["Cotton", "Polyester", "Wool", "Leather", "Silk", "Linen", "Denim"]
            ]
        ];

        foreach ($attributes as $attribute) {
            // Insert attribute to `attributes` table
            $newAttribute = Attributes::create([
                'name' => $attribute["name"]
            ]);

            // Insert each value to `attribute_values` table
            foreach ($attribute["values"] as $value) {
                AttributesValue::create([
                    'attributes_id' => $newAttribute->id,
                    'name' => $value
                ]);
            }
        }
    }
}
