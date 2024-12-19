<?php

namespace Database\Seeders;

use App\Models\Footer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Footer::create([
            'address' => '562 Wellington Road, Street 32, San Francisco',
            'phone' => '+1234567890',
            'show_link' => 'Yes',
            'email' => 'example@domain.com',
            'facebook' => 'https://facebook.com/sample',
            'instagram' => 'https://instagram.com/sample',
            'twitter' => 'https://twitter.com/sample',
            'youtube' => 'https://youtube.com/sample',
            'pinterest' => 'https://pinterest.com/sample',
            'show_store' => 'No',
            'app_store' => 'https://appstore.com/sample',
            'play_store' => 'https://playstore.com/sample',
            'image1' => 'path/to/image1.jpg',
            'image2' => 'path/to/image2.jpg',
            'ext1' => 'jpg',
            'size1' => '500',
            'ext2' => 'png',
            'size2' => '300',
            'link_menu' => json_encode([
                ['title' => 'About Us', 'url' => '/about'],
                ['title' => 'Delivery Information', 'url' => '/delivery'],
                ['title' => 'Privacy Policy', 'url' => '/privacy'],
                ['title' => 'Terms & Conditions', 'url' => '/terms'],
                ['title' => 'Contact Us', 'url' => '/contact'],
                ['title' => 'Support Center', 'url' => '/support']
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
