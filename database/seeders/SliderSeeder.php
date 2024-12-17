<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SliderGroups;
use App\Models\SliderItems;

class SliderSeeder extends Seeder
{
    public function run()
    {
        // Data slider groups
        $sliderGroups = [
            ['title' => 'Home Page', 'name' => 'homepage', 'order' => 1],
            ['title' => 'Todays Deal', 'name' => 'todaysdeal', 'order' => 2],
            ['title' => 'Banner Level 1', 'name' => 'banner_level_1', 'order' => 3],
            ['title' => 'Banner Level 2', 'name' => 'banner_level_2', 'order' => 4],
        ];

        // Placeholder untuk gambar
        // $placeholderImage = 'https://via.placeholder.com/800x400.png?text=Placeholder+Image';

        // Data slider items per group
        $sliderItemsData = [
            'homepage' => [
                [
                    'title_h4' => 'Welcome to Our Store',
                    'subtitle_h2' => 'Amazing Deals',
                    'main_heading_h1' => 'Shop the Best',
                    'description_p' => 'Discover top-quality products at unbeatable prices.',
                    'link_url' => '/shop',
                    'order' => 1,
                ],
                [
                    'title_h4' => 'Explore New Arrivals',
                    'subtitle_h2' => 'Fresh Styles',
                    'main_heading_h1' => 'Stay Trendy',
                    'description_p' => 'Check out our latest collection today.',
                    'link_url' => '/new-arrivals',
                    'order' => 2,
                ],
            ],
            'todaysdeal' => [
                [
                    'title_h4' => 'Hot Deals Today',
                    'subtitle_h2' => 'Grab Before It’s Gone',
                    'main_heading_h1' => 'Save More!',
                    'description_p' => 'Unbelievable discounts just for you.',
                    'link_url' => '/deals',
                    'order' => 1,
                ],
                [
                    'title_h4' => 'Limited Time Offer',
                    'subtitle_h2' => 'Don’t Miss Out!',
                    'main_heading_h1' => 'Act Fast!',
                    'description_p' => 'Shop now to avail exclusive discounts.',
                    'link_url' => '/special-offer',
                    'order' => 2,
                ],
            ],
            'banner_level_1' => [
                [
                    'title_h4' => 'Big Discounts',
                    'subtitle_h2' => 'Seasonal Sale',
                    'main_heading_h1' => 'Up to 50% Off',
                    'description_p' => 'Shop your favorite items at discounted prices.',
                    'link_url' => '/sale',
                    'order' => 1,
                ],
                [
                    'title_h4' => 'Special Gifts',
                    'subtitle_h2' => 'Perfect for Holidays',
                    'main_heading_h1' => 'Gift Ideas',
                    'description_p' => 'Find the perfect gift for your loved ones.',
                    'link_url' => '/gifts',
                    'order' => 2,
                ],
            ],
            'banner_level_2' => [
                [
                    'title_h4' => 'Exclusive Offers',
                    'subtitle_h2' => 'Members Only',
                    'main_heading_h1' => 'Join Us!',
                    'description_p' => 'Get special deals and discounts for members.',
                    'link_url' => '/join',
                    'order' => 1,
                ],
                [
                    'title_h4' => 'Flash Sale',
                    'subtitle_h2' => 'Hurry Up!',
                    'main_heading_h1' => 'Limited Stocks',
                    'description_p' => 'Once it’s gone, it’s gone forever.',
                    'link_url' => '/flash-sale',
                    'order' => 2,
                ],
            ],
        ];

        // Create slider groups and their associated slider items
        foreach ($sliderGroups as $group) {
            $groupModel = SliderGroups::create($group);

            // Get the corresponding slider items for the group
            $sliderItems = $sliderItemsData[$group['name']];

            // Create slider items for the current group
            foreach ($sliderItems as $item) {
                SliderItems::create(array_merge($item, ['slider_groups_id' => $groupModel->id]));
            }
        }
    }
}
