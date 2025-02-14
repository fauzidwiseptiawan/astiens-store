<?php

namespace Database\Seeders;

use App\Models\Appearance;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AppearanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Appearance::create([
            'name' => 'Example Site',
            'site_name' => 'example.com',
            'motto' => 'Quality and Excellence',
            'color_base' => '#FFA000',
            'hover_base' => '#FFD54F',
            'color_sec' => '#FFF3E0',
            'hover_sec' => '#FFECB3',
            'meta_title' => 'Welcome to Example Site',
            'meta_desc' => 'Example site description.',
            'meta_key' => 'example, demo, website',
            'cookies_txt' => 'We use cookies to ensure you get the best experience.',
            'icon' => 'icon.png',
            'ext' => 'png',
            'size' => 51234, // in bytes
            'created_at' => Carbon::now(),
            // 'created_by' => $faker->randomDigitNotNull,
            'updated_at' => null,
            'updated_by' => null, // Example user ID
            'deleted_at' => null,
            'deleted_by' => null,
        ]);
    }
}
