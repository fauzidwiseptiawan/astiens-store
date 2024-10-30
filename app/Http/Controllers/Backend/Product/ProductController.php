<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\AttributesValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

    // Kombinasi varian produk
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

    function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'item_code'         => 'required|string|max:255|unique:product,item_code',
                // 'category_id'       => 'required|exists:category,id',
                // 'sub_category_id'   => 'required|exists:sub_category,id',
                // 'brand_id'          => 'required|exists:brand,id',
                // 'name'              => 'required|string|max:255',
                // 'slugs'             => 'required|string|max:255|unique:product,slugs',
                // 'unit'              => 'required|string|max:50',
                // 'min_qty'           => 'required|integer|min:1',
                // 'max_qty'           => 'required|integer|gt:min_qty',
                // 'barcode'           => 'nullable|max:255|unique:product,barcode',
                // 'short_desc'        => 'nullable|string|max:500',
                // 'long_desc'         => 'required|string',
                // 'tags'              => 'nullable|string|max:255',
                // 'seo'               => 'nullable|string|max:255',
                // 'seo_desc'          => 'nullable|string|max:500',
            ],
        );
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            // Memulai transaksi
            DB::beginTransaction();

            try {
                // Menyimpan data produk
                $product = new Product();
                $product->item_code = $request->item_code;
                $product->category_id = $request->category_id;
                $product->sub_category_id = $request->sub_category_id;
                $product->brand_id = $request->brand_id;
                $product->name = $request->name;
                $product->slugs = $request->slugs;
                $product->unit = $request->unit;
                $product->barcode = $request->barcode;
                $product->min_qty = $request->min_qty;
                $product->max_qty = $request->max_qty;
                $product->stock = $request->stock;
                $product->price = $request->price;
                $product->price = $request->price;
                $product->sku = $request->sku;
                $product->short_desc = $request->short_desc;
                $product->long_desc = $request->long_desc;
                $product->is_feature = $request->is_feature;
                $product->new_arrival = $request->new_arrival;
                $product->best_seller = $request->best_seller;
                $product->special_offer = $request->special_offer;
                $product->seo_title = $request->seo_title;
                $product->seo_desc = $request->seo_desc;
                $product->hot = $request->hot;
                $product->new = $request->new;
                $product->sale = $request->sale;
                $product->tags = $request->tags ? json_encode($request->tags) : null;

                // Menyimpan gambar utama
                if ($request->hasFile('image')) {
                    $product->image = $request->file('image')->store('products', 'public');
                }

                // Simpan ke database
                $product->save();

                // Menyimpan varian produk jika ada
                if ($request->is_variant) {
                    // Pastikan kita memiliki array untuk variant_attributes dan choice_attributes
                    if (is_array($request->variant_attributes) && is_array($request->choice_attributes)) {
                        foreach ($request->variant_attributes as $index => $attribute) {
                            // Cek apakah choice_attributes untuk index ini ada dan merupakan array
                            if (isset($request->choice_attributes[$index]) && is_array($request->choice_attributes[$index])) {
                                // Buat string choiceAttributes dengan implode untuk setiap pilihan di choice_attributes
                                $choiceAttributes = implode(' - ', $request->choice_attributes[$index]);
                            } else {
                                $choiceAttributes = null; // Atau nilai default yang sesuai
                            }

                            // Buat record varian
                            $variant = new ProductVariant([
                                'product_id' => $product->id, // Mengaitkan dengan produk yang baru disimpan
                                'variant' => $choiceAttributes, // Menggunakan choiceAttributes yang sesuai untuk setiap iterasi
                                'variant_attribute' => $attribute,
                                'price' => (int) str_replace('.', '', str_replace('Rp', '', $request->variant_price[$index] ?? '0')), // Gunakan ?? untuk menangani undefined
                                'stock' => $request->variant_stock[$index] ?? 0, // Gunakan ?? untuk menangani undefined
                                'sku' => $request->variant_sku[$index] ?? '', // Gunakan ?? untuk menangani undefined
                            ]);

                            // Upload gambar varian jika ada
                            if ($request->hasFile("variant_image.$index")) {
                                $variant->image = $request->file("variant_image.$index")->store('variants', 'public');
                            }

                            // Simpan varian ke database
                            $variant->save();
                        }
                    } else {
                        // Tangani situasi ketika data tidak terformat dengan benar
                        return response()->json(['error' => 'Invalid input format.'], 400);
                    }
                }


                // Menyimpan gambar tambahan
                if ($request->hasFile('image2')) {
                    foreach ($request->file('image2') as $image) {
                        $path = $image->store('products', 'public');
                        // Logika untuk menyimpan nama gambar ke tabel yang sesuai
                        ProductImage::create(['product_id' => $product->id, 'image' => $path]);
                    }
                }

                // Jika semua operasi sukses, commit transaksi
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'message' => 'Produk berhasil disimpan.',
                ]);
            } catch (\Exception $e) {
                // Jika terjadi kesalahan, rollback transaksi
                DB::rollback();

                return response()->json([
                    'status' => 500,
                    'message' => 'Terjadi kesalahan saat menyimpan produk: ' . $e->getMessage(),
                ]);
            }
        }
    }
}
