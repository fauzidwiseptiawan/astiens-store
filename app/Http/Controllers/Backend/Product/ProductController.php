<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\AttributesValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        return view('backend.product.index');
    }

    // Method get attributes value
    function get_value($id)
    {
        try {
            $value = AttributesValue::where('attributes_id', $id)->where('is_active', '1')->orderBy('name', 'ASC')->get();
            return response()->json([
                'status'       => 200,
                'message'      => 'success',
                'data'         => $value,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status'       => 400,
                'message'      => $e->getMessage(),
            ]);
        }
    }

    // Methode generate item code otomatis
    public function generate_item_code()
    {
        try {
            // Ambil semua item dari database
            $product = Product::all();
            $count = $product->count();
            // Generate kode item baru, misalnya dengan menambahkan 1 pada ID terakhir
            $newCode = 'ITEM' . str_pad($count + 1, 5, '0', STR_PAD_LEFT);
            return response()->json([
                'status'       => 200,
                'message'      => 'success',
                'data'         => $newCode,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status'       => 400,
                'message'      => $e->getMessage(),
            ]);
        }
    }

    // Method get sub category
    function sub_category($id)
    {
        try {
            $value = SubCategory::where('category_id', $id)->where('is_active', '1')->orderBy('name', 'ASC')->get();
            return response()->json([
                'status'       => 200,
                'message'      => 'success',
                'data'         => $value,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status'       => 400,
                'message'      => $e->getMessage(),
            ]);
        }
    }

    // Method untuk membuat kombinasi varian produk
    public function create_variants(Request $request)
    {
        $selectedAttributes = $request->input('attributes');

        // Pastikan kita tetap menjalankan logika meskipun tidak ada atribut yang dipilih
        if (empty($selectedAttributes)) {
            return response()->json([]); // Mengembalikan array kosong
        }

        foreach ($selectedAttributes as $attribute) {
            if (!isset($attribute['values'])) {
                $attribute['values'] = []; // Menetapkan default ke array kosong jika tidak ada
            }
        }

        $productVariants = $this->createCombinations($selectedAttributes);

        // Pastikan $productVariants adalah array
        return response()->json($productVariants);
    }

    // kombinasi varian produk
    private function createCombinations($attributes)
    {
        if (count($attributes) === 0) return [];

        if (count($attributes) === 1) {
            return array_map(function ($val) {
                return [$val];
            }, $attributes[0]['values']);
        }

        $combinations = [];
        $restCombinations = $this->createCombinations(array_slice($attributes, 1));

        foreach ($attributes[0]['values'] as $val) {
            foreach ($restCombinations as $combination) {
                $combinations[] = array_merge([$val], $combination);
            }
        }

        return $combinations;
    }

    function create()
    {
        $attributes = Attributes::where('is_active', '1')->orderBy('name', 'ASC')->get();
        $brand = Brand::where('is_active', '1')->orderBy('name', 'ASC')->get();
        $category = Category::where('is_active', '1')->orderBy('name', 'ASC')->get();
        return view('backend.product.add', compact('attributes', 'brand', 'category'));
    }
}
