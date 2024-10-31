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
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Helpers\NumberFormatter;

class ProductController extends Controller
{
    function index()
    {
        $brand = Brand::where('is_active', '1')->orderBy('name', 'ASC')->get();
        $category = Category::where('is_active', '1')->orderBy('name', 'ASC')->get();
        return view('backend.product.index', compact('brand', 'category'));
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
                'status' => 500,
                'message' => 'An error occurred while get value.',
                'error' => $e->getMessage(), // Tambahkan pesan error asli di sini
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

    function fetch()
    {
        // fetch product
        $product = Product::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        // display result datatable
        return datatables()
            ->of($product)
            ->addIndexColumn()
            ->addColumn('select_all', function ($product) {
                return '<input type="checkbox" class="form-check-input select-form" id="select" name="select" value="' . $product->id . '">';
            })
            ->addColumn('name', function ($product) {
                return '<div class="d-flex p-1">
		                   <img src="' . asset('storage/upload/image/product/thumbnail/' . $product->image) . '" class="me-2 img-fluid avatar-md rounded" height="80" alt="Arya Stark" />
		                        <div class="w-100">
		                            <p class="mt-0">' . $product->name . ' </p>
		                        </div>
		                </div>';
            })
            ->addColumn('brand', function ($product) {
                return $product->brand->name;
            })
            ->addColumn('category', function ($product) {
                return $product->category->name;
            })
            ->addColumn('info', function ($product) {
                // Mengambil harga produk jika ada
                $bestPrice = $product->price ?? null; // Asumsikan 'price' adalah atribut harga produk

                // Jika harga produk tidak ada, ambil dari harga varian produk pertama
                if (!$bestPrice && $product->variants && count($product->variants) > 0) {
                    $bestPrice = $product->variants[0]->price; // Asumsikan 'price' adalah atribut harga varian
                }
                // set default penjualan
                $numOfSale = 51;
                return '
                    <div style="margin-bottom: 5px;">
                        ' . ($numOfSale > 50 ? '<span class="badge bg-success">Best Seller</span>' : '') . '
                    </div>
                    <strong>Num of Sale:</strong> ' . $numOfSale . ' times
                    <br>
                    <strong>Price:</strong> Rp.' . NumberFormatter::format($bestPrice ?? 0) . '
                    <br>
                    <div style="display: flex; align-items: center;">
                        <strong style="margin-right: 10px;">Rating:</strong>
                        <div class="rateit" data-rateit-mode="font" data-rateit-readonly="true" data-rateit-value="2.5" data-rateit-ispreset="true"></div>
                    </div>
                ';
            })
            ->addColumn('stock', function ($product) {
                if ($product->is_variant == 1) {
                    // Loop melalui setiap varian dan ambil atributnya
                    return $product->variants->map(function ($variant) {
                        // Cek jika stok varian 0
                        if ($variant->stock == 0) {
                            $badge = '<span class="badge bg-danger">not available</span>';
                        }
                        // Cek jika stok varian kurang dari 2
                        elseif ($variant->stock < 2) {
                            $badge = '<span class="badge bg-warning">low</span>';
                        }
                        // Jika stok varian 2 atau lebih, tidak ada badge
                        else {
                            $badge = '';
                        }

                        return $variant->variant_attribute . ' - ' . $variant->stock . ' ' . $badge;
                    })->implode('<br>'); // Menggabungkan dengan <br> sebagai pemisah
                } else {
                    // Cek apakah stok produk 0
                    if ($product->stock == 0) {
                        return '<span class="badge bg-danger">not available</span>';
                    }
                    // Cek apakah stok produk kurang dari 2
                    elseif ($product->stock < 2) {
                        return $product->stock . ' <span class="badge bg-warning">low</span>';
                    }
                    // Jika stok lebih dari 1, tampilkan hanya stok
                    else {
                        return $product->stock;
                    }
                }
            })

            ->addColumn('special_offer', function ($product) {
                if ($product->special_offer == 1) {
                    return '<label class="slideon">
							<input type="checkbox" name="special_offer" class="switch" data-active="' . $product->id . '" value"1" checked>
							<span class="slideon-slider"></span>
						</label>';
                } else {
                    return '<label class="slideon">
							<input type="checkbox" name="special_offer" class="switch" data-active="' . $product->id . '" value"0">
							<span class="slideon-slider"></span>
						</label>';
                }
            })
            ->addColumn('feature', function ($product) {
                if ($product->is_feature == 1) {
                    return '<label class="slideon">
							<input type="checkbox" name="is_feature" class="switch" data-active="' . $product->id . '" value"1" checked>
							<span class="slideon-slider"></span>
						</label>';
                } else {
                    return '<label class="slideon">
							<input type="checkbox" name="is_feature" class="switch" data-active="' . $product->id . '" value"0">
							<span class="slideon-slider"></span>
						</label>';
                }
            })
            ->addColumn('publish', function ($product) {
                if ($product->is_active == 1) {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch" data-active="' . $product->id . '" value"1" checked>
							<span class="slideon-slider"></span>
						</label>';
                } else {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch" data-active="' . $product->id . '" value"0">
							<span class="slideon-slider"></span>
						</label>';
                }
            })
            ->addColumn('action', function ($product) {
                return ' <div class="d-flex flex-wrap gap-2">
                            <button type="button" id="view" value="' . $product->id . '"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="success-tooltip" data-bs-title="View" class="btn btn-circle btn-soft-success btn-sm"><i class="ri-eye-fill"></i></button>
							<button type="button" id="show" value="' . $product->id . '" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="warning-tooltip" data-bs-title="Edit" class="btn btn-circle btn-soft-warning btn-sm"><i class="ri-pencil-fill"></i></button>
                            <button type="button" id="destroySoft" value="' . $product->id . '"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Delete" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-delete-bin-5-line"></i></button>
					</div>';
            })
            ->rawColumns(['select_all', 'name', 'brand', 'category', 'info', 'stock', 'publish', 'feature', 'special_offer', 'action'])
            ->make(true);
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
                'category_id'       => 'required|exists:category,id',
                'sub_category_id'   => 'required|exists:sub_category,id',
                'brand_id'          => 'required|exists:brand,id',
                'name'              => 'required|string|max:255',
                'slugs'             => 'required|string|max:255|unique:product,slugs',
                'unit'              => 'required|string|max:50',
                'barcode'           => 'nullable|max:255|unique:product,barcode',
                'short_desc'        => 'nullable|string|max:500',
                'long_desc'         => 'required|string',
                'tags'              => 'nullable|string|max:255',
                'seo'               => 'nullable|string|max:255',
                'seo_desc'          => 'nullable|string|max:500',
                'is_active'         => 'required',
                'tags'              => 'required',
                'image1'            => 'required|image|mimes:jpeg,jpg,png,gif|max:2048', // 2MB Max
                'price'             => 'required_if:is_variant,0|min:0',
                'stock'             => 'required_if:is_variant,0|integer|min:0',
                'sku'               => 'required_if:is_variant,0|string|max:255',
                'is_variant'        => 'required|boolean',
            ],

        );

        $validator->setCustomMessages([
            'price.required_if' => 'The price field is required.',
            'stock.required_if' => 'The stock field is required.',
            'sku.required_if' => 'The sku field is required.',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            // Memulai transaksi
            DB::beginTransaction();

            try {
                $dateRange = $request->input('discount_range');
                // Memastikan bahwa dateRange tidak kosong
                if (empty($dateRange)) {
                    $startDate = null;
                    $endDate = null;
                } else {
                    [$startDate, $endDate] = explode(' to ', $dateRange);
                }
                // Menyimpan data produk
                $product = new Product();
                $product->item_code = $request->item_code;
                $product->category_id = $request->category_id;
                $product->sub_category_id = $request->sub_category_id;
                $product->brand_id = $request->brand_id;
                $product->name = $request->name;
                $product->slugs = $request->slugs;
                $product->unit = $request->unit;
                $product->discount_start_date = $startDate;
                $product->discount_end_date = $endDate;
                $product->discount = $request->discount;
                $product->barcode = $request->barcode;
                $product->min_qty = $request->min_qty;
                $product->max_qty = $request->max_qty;
                $product->stock = $request->stock;
                $product->price = (int) preg_replace('/[^0-9]/', '', $request->price ?? '0');
                $product->sku = $request->sku;
                $product->short_desc = $request->short_desc;
                $product->long_desc = $request->long_desc;
                $product->is_feature = $request->is_feature;
                $product->refundable = $request->refundable;
                $product->new_arrival = $request->new_arrival;
                $product->best_seller = $request->best_seller;
                $product->special_offer = $request->special_offer;
                $product->seo_title = $request->seo_title;
                $product->seo_desc = $request->seo_desc;
                $product->is_active = $request->is_active;
                $product->hot = $request->hot;
                $product->new = $request->new;
                $product->sale = $request->sale;
                $product->tags = $request->tags ? json_encode($request->tags) : null;
                $product->created_by = Auth::user()->id;
                $product->created_at = now();

                // Menyimpan gambar utama
                if ($request->hasFile('image1')) {
                    $path_single = 'upload/image/product';
                    $path_resize_single = 'upload/image/product/thumbnail';
                    $file_single = $request->file('image1');
                    $file_single_name = time() . '_' . $file_single->getClientOriginalName();
                    $file_single_size = $file_single->getSize();
                    $file_single_extension = $file_single->extension();
                    $file_single->storeAs($path_single, $file_single_name, 'public');
                    // resize image
                    $manager = new ImageManager(new Driver());
                    $resize_img = $manager->read($file_single);
                    $resize_img->resize(300, 300)->save($file_single);
                    $file_single->storeAs($path_resize_single, $file_single_name, 'public');

                    $product->image = $file_single_name;
                    $product->ext = $file_single_extension;
                    $product->size = $file_single_size;
                }

                // Simpan ke database
                $product->save();

                // Menyimpan varian produk jika ada
                if ($request->is_variant == 1) {
                    // Pastikan kita memiliki array untuk variant_attributes dan choice_attributes
                    if (is_array($request->variant_attributes) && is_array($request->choice_attributes)) {
                        foreach ($request->variant_attributes as $index => $attribute) {
                            // Cek apakah choice_attributes untuk index ini ada dan merupakan array
                            if (isset($request->choice_attributes[$index]) && is_array($request->choice_attributes[$index])) {
                                // Buat string choiceAttributes dengan implode untuk setiap pilihan di choice_attributes
                                $choiceAttributes = implode(' - ', $request->choice_attributes[$index]);
                            } else {
                                $choiceAttributes = ''; // Ganti dengan nilai default yang sesuai, misalnya string kosong
                            }
                            // convert string rupiah ke interger
                            $price = (int) preg_replace('/[^0-9]/', '', $request->variant_price[$index] ?? '0');
                            // Buat record varian
                            $variant = new ProductVariant([
                                'product_id' => $product->id,
                                'variant' => $choiceAttributes,
                                'variant_attribute' => $attribute,
                                'price' => $price,
                                'stock' => $request->variant_stock[$index] ?? 0,
                                'sku' => $request->variant_sku[$index] ?? '',
                                'created_by' => Auth::user()->id,
                                'created_at' => now(),
                            ]);

                            // Upload gambar varian jika ada
                            if ($request->hasFile("variant_image.$index")) {
                                $path_variant = 'upload/image/product/variant';
                                $path_variant_resize = 'upload/image/product/variant/thumbnail';
                                $file_variant = $request->file("variant_image.$index");
                                $file_variant_name = time() . '_' . $file_variant->getClientOriginalName();
                                $file_variant_size = $file_variant->getSize();
                                $file_variant_extension = $file_variant->extension();
                                $file_variant->storeAs($path_variant, $file_variant_name, 'public');
                                // resize image
                                $manager = new ImageManager(new Driver());
                                $resize_variant_img = $manager->read($file_variant);
                                $resize_variant_img->resize(300, 300)->save($file_variant);
                                $file_variant->storeAs($path_variant_resize, $file_variant_name, 'public');

                                $variant->image = $file_variant_name;
                                $variant->ext = $file_variant_extension;
                                $variant->size = $file_variant_size;
                            }

                            // Simpan varian ke database
                            $variant->save();
                        }
                    } else {
                        // Tangani situasi ketika data tidak terformat dengan benar
                        return response()->json([
                            'status'   => 400,
                            'message' => 'Invalid input format.'
                        ]);
                    }
                }

                // Menyimpan gambar tambahan
                if ($request->hasFile('image2')) {
                    foreach ($request->file('image2') as $image_multiple) {
                        // Pastikan file adalah instance yang valid
                        if ($image_multiple->isValid()) {
                            $path_multiple = 'upload/image/product/gallery';
                            $path_multiple_resize = 'upload/image/product/gallery/thumbnail';
                            $file_multiple = $image_multiple;
                            $file_multiple_name = $product->id . '-' . time() . '_' . $file_multiple->getClientOriginalName();
                            $file_multiple_size = $file_multiple->getSize();
                            $file_multiple_extension = $file_multiple->extension();
                            $file_multiple->storeAs($path_multiple, $file_multiple_name, 'public');
                            // resize image
                            $manager = new ImageManager(new Driver());
                            $resize_img = $manager->read($file_multiple);
                            $resize_img->resize(300, 300)->save($file_multiple);
                            $file_multiple->storeAs($path_multiple_resize, $file_multiple_name, 'public');
                            // validation is successful it is saved to the database
                            ProductImage::create([
                                'product_id' => $product->id,
                                'image'      => $file_multiple_name,
                                'ext'        => $file_multiple_extension,
                                'size'       => $file_multiple_size,
                                'created_by' => Auth::user()->id,
                                'created_at' => now(),
                            ]);
                        }
                    }
                }
                // Jika semua operasi sukses, commit transaksi
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'message' => 'Adding product data was successful!',
                ]);
            } catch (\Exception $e) {
                // Jika terjadi kesalahan, rollback transaksi
                DB::rollback();
                return response()->json([
                    'status' => 500,
                    'message' => 'An error occurred while saving the product.',
                    'error' => $e->getMessage(), // Tambahkan pesan error asli di sini
                ]);
            }
        }
    }
}
