<?php

namespace Database\Seeders;

use App\Models\Header;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Header::create([
            'title_promo' => json_encode([
                ['title' => 'Discount 50% on selected items'],
                ['title' => 'Buy 1 Get 1 Free']
            ]),
            'image' => 'https://placehold.co/100',
            'ext' => 'jpg',
            'size' => 2048, // ukuran dalam KB
            'nav_menu' => json_encode([
                ['name' => 'Home', 'url' => '/home'],
                ['name' => 'About', 'url' => '/about'],
                ['name' => 'Shop', 'url' => '/shop'],
                ['name' => 'Contact', 'url' => '/contact']
            ]),
        ]);
    }
}
