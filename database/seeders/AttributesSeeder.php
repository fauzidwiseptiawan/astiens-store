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
                "values" => ["S", "M", "L", "XL", "XXL"]
            ],
            [
                "name" => "Material",
                "values" => ["Cotton", "Polyester", "Wool"]
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
