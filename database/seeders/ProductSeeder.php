<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Step 1: Membuat beberapa kategori dan subkategori
        $category = ['Electronics', 'Fashion', 'Home Appliances', 'Books', 'Toys'];
        $subCategory = [
            'Electronics' => ['Mobile Phones', 'Laptops', 'Cameras', 'Headphones', 'TVs'],
            'Fashion' => ['Men\'s Clothing', 'Women\'s Clothing', 'Footwear', 'Accessories', 'Watches'],
            'Home Appliances' => ['Refrigerators', 'Washing Machines', 'Microwaves', 'Air Conditioners', 'Vacuum Cleaners'],
            'Books' => ['Fiction', 'Non-fiction', 'Science', 'Self-help', 'Comics'],
            'Toys' => ['Action Figures', 'Board Games', 'Building Blocks', 'Dolls', 'Outdoor Toys'],
        ];
        foreach ($category as $key => $categoryName) {
            // Create category
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'position_order' => $key,
                'meta' => $faker->sentence(),
                'meta_desc' => $faker->paragraph(),
            ]);

            // Create subcategories based on the predefined list
            if (isset($subCategory[$categoryName])) {
                foreach ($subCategory[$categoryName] as $subCategoryName) {
                    SubCategory::create([
                        'category_id' => $category->id,
                        'name' => $subCategoryName,
                        'slug' => Str::slug($subCategoryName),
                    ]);
                }
            }
        }

        // Step 2: Membuat beberapa brand
        $brands = [];
        $predefinedBrands = [
            'Apple',
            'Samsung',
            'Nike',
            'Adidas',
            'Sony',
            'LG',
            'Dell',
            'HP',
            'Bose',
            'Huawei',
            'Canon',
            'Panasonic',
            'Philips',
            'Puma',
            'Reebok',
            'Under Armour',
            'Microsoft',
            'Xiaomi'
        ];

        foreach ($predefinedBrands as $brandName) {
            $brand = Brand::create([
                'name' => $brandName,
                'slug' => Str::slug($brandName),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $brands[] = $brand->id;
        }

        // Step 3: Membuat produk dengan relasi ke kategori, subkategori, dan brand
        $category = Category::all();
        foreach ($category as $category) {
            $subCategory = $category->subCategory; // Dapatkan semua subkategori untuk kategori ini
            // Pastikan subkategori tidak null atau kosong
            if ($subCategory->isEmpty()) {
                continue; // Lewati kategori ini jika tidak ada subkategori
            }
            foreach ($subCategory as $subCategory) {
                // Membuat produk untuk setiap kombinasi kategori dan subkategori
                $nameProduct = $faker->words(4, true);
                for ($i = 0; $i < 1; $i++) {
                    Product::create([
                        'item_code' => $faker->unique()->numerify('ITEM-####'),
                        'category_id' => $category->id,
                        'sub_category_id' => $subCategory->id,
                        'brand_id' => $faker->randomElement($brands),
                        'name' => $nameProduct,
                        'slugs' => Str::slug($nameProduct),
                        'unit' => strtoupper($faker->randomElement(['pcs', 'set', 'pack'])),
                        'weight' => $faker->randomElement([1000, 2000]),
                        'min_qty' => $faker->numberBetween(1, 5),
                        'max_qty' => $faker->numberBetween(5, 20),
                        'barcode' => $faker->ean13,
                        'image' => null,
                        'ext' => null,
                        'size' => null,
                        'price' => $faker->numberBetween(2, 5) * 500000,
                        'sku' => $faker->unique()->numerify('SKU-####'),
                        'stock' => $faker->numberBetween(1, 100),
                        'discount_start_date' => $faker->dateTimeBetween('-1 month', 'now'),
                        'discount_end_date' => $faker->dateTimeBetween('now', '+1 month'),
                        'discount' => $faker->numberBetween(0, 50),
                        'short_desc' => $faker->sentence,
                        'long_desc' => $faker->paragraph,
                        'tags' => implode(',', $faker->words(3)),
                        'seo_title' => $faker->sentence,
                        'seo_desc' => $faker->sentence,
                        'new_arrival' => $faker->boolean ? 'yes' : 'no',  // ENUM,
                        'best_seller' => $faker->boolean ? 'yes' : 'no',  // ENUM,
                        'special_offer' => $faker->boolean ? 'yes' : 'no',  // ENUM,
                        'hot' => $faker->boolean ? 'yes' : 'no',  // ENUM,
                        'new' => $faker->boolean ? 'yes' : 'no',  // ENUM,
                        'sale' => $faker->boolean ? 'yes' : 'no',  // ENUM,
                        'is_active' => 1,  // TINYINT (1 for active)
                        'is_deleted' => 0,  // TINYINT (0 for not deleted)
                        'created_at' => Carbon::now(),
                        'created_by' => $faker->randomDigitNotNull,
                    ]);
                }
            }
        }
    }
}
