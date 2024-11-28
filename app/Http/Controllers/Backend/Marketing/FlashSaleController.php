<?php

namespace App\Http\Controllers\Backend\Marketing;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleProduct;
use App\Models\Product;
use App\Services\ImageUploadService;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class FlashSaleController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        return view('backend.flash_sale.index');
    }

    public function create()
    {
        $products = Product::withoutGlobalScope(ActiveScope::class)->orderBy('name', 'ASC')->get();
        return view('backend.flash_sale.add', compact('products'));
    }

    public function get_product($productId)
    {
        try {
            // Mencari produk berdasarkan ID
            $product = Product::find($productId);

            // Cek jika produk ditemukan
            if ($product) {
                return response()->json([
                    'success' => true,
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found!'
                ], 404);  // Jika produk tidak ditemukan
            }
        } catch (\Exception $e) {
            // Menangkap semua exception
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching the product.',
                'error' => $e->getMessage() // Optional: Jangan tampilkan error asli di produksi
            ], 500);  // Internal Server Error
        }
    }

    public function fetch()
    {
        // fetch flash_sale
        $flash_sale = FlashSale::withoutGlobalScope(ActiveScope::class)->orderBy('id', 'ASC')->get();
        // display result datatable
        return datatables()
            ->of($flash_sale)
            ->addIndexColumn()
            ->addColumn('select_all', function ($flash_sale) {
                return '<input type="checkbox" class="form-check-input select-form" id="select" name="select" value="' . $flash_sale->id . '">';
            })

            ->addColumn('image', function ($flash_sale) {
                if ($flash_sale != null && !empty($flash_sale->image)) {
                    return '<img src="' . asset('storage/upload/image/flash_sale/thumbnail/' . $flash_sale->image) . '" class="img-thumbnail" height="80" width="80" alt="' . asset('storage/upload/image/flash_sale/' . $flash_sale->image) . '">';
                } else {
                    return '<img src="https://placehold.co/400" class="img-thumbnail" height="80" width="80" alt="https://placehold.co/400">';
                }
            })
            ->addColumn('publish', function ($flash_sale) {
                if ($flash_sale->is_active == 1) {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch is_active" data-active="' . $flash_sale->id . '" value"1" checked>
							<span class="slideon-slider"></span>
						</label>';
                } else {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch is_active" data-active="' . $flash_sale->id . '" value"0">
							<span class="slideon-slider"></span>
						</label>';
                }
            })
            ->addColumn('feature', function ($flash_sale) {
                if ($flash_sale->is_feature == 1) {
                    return '<label class="slideon">
							<input type="checkbox" name="is_feature" class="switch is_feature" data-active="' . $flash_sale->id . '" value"1" checked>
							<span class="slideon-slider"></span>
						</label>';
                } else {
                    return '<label class="slideon">
							<input type="checkbox" name="is_feature" class="switch is_feature" data-active="' . $flash_sale->id . '" value"0">
							<span class="slideon-slider"></span>
						</label>';
                }
            })
            ->addColumn('action', function ($flash_sale) {
                return ' <div class="d-flex flex-wrap gap-2">
                            <a href="' . route('flash-sale.show', ['flash_sale' => $flash_sale->id]) . '">
							    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="warning-tooltip" data-bs-title="Edit" class="btn btn-circle btn-soft-warning btn-sm"><i class="ri-pencil-fill"></i></button>
                            </a>
                            <button type="button" id="destroySoft" value="' . $flash_sale->id . '"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Delete" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-delete-bin-5-line"></i></button
					</div>';
            })
            ->rawColumns(['action', 'publish', 'feature', 'image', 'select_all'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'slugs'  => 'required',
            'date'   => 'required',
            'image'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
                // check if validate by adding image
                if (!$request->hasFile('image') == "") {
                    $path = 'upload/image/flash_sale';
                    $pathResize = 'upload/image/flash_sale/thumbnail';

                    // Menggunakan service untuk meng-upload dan meresize gambar
                    $fileInfo = $this->imageUploadService->uploadAndResize(
                        $request->file('image'),
                        $path,
                        $pathResize
                    );
                    $dateRange = $request->input('date');
                    // Memastikan bahwa dateRange tidak kosong
                    if (empty($dateRange)) {
                        $startDate = null;
                        $endDate = null;
                    } else {
                        [$startDate, $endDate] = explode(' to ', $dateRange);
                    }
                    // validation is successful it is saved to the database
                    $flash_sale = new FlashSale();
                    $flash_sale->name = $request->name;
                    $flash_sale->slug = $request->slugs;
                    $flash_sale->start_date = $startDate;
                    $flash_sale->end_date = $endDate;
                    $flash_sale->image = $fileInfo['file_name'];
                    $flash_sale->ext =  $fileInfo['file_extension'];
                    $flash_sale->size = $fileInfo['file_size'];
                    $flash_sale->created_by =  Auth::user()->id;
                    $flash_sale->created_at =  now();

                    // Simpan ke database
                    $flash_sale->save();

                    foreach ($request->product as $index => $product) {
                        // Create the ProductVariant
                        $flash_sale_product = new FlashSaleProduct([
                            'flash_sale_id' => $flash_sale->id,
                            'product_id' => $product,
                            'discount_price' => $request->discount[$index] ?? 0,
                            'discount_type' => $request->type[$index] ?? '',
                            'created_at' => now(),
                        ]);

                        // Save the variant
                        $flash_sale_product->save();
                    }

                    // Jika semua operasi sukses, commit transaksi
                    DB::commit();

                    return response()->json([
                        'status'   => 200,
                        'message'  => 'Adding flash sale data was successful!'
                    ]);
                } else {
                    return response()->json([
                        'status'   => 400,
                        'message'  => 'Failed to add flash sale data!'
                    ]);
                }
            } catch (\Throwable $e) {
                // Jika terjadi kesalahan, rollback transaksi
                DB::rollback();
                return response()->json([
                    'status' => 500,
                    'message' => 'An error occurred while saving the flash sale.',
                    'error' => $e->getMessage(), // Tambahkan pesan error asli di sini
                ]);
            }
        }
    }

    public function show($id)
    {
        $products = Product::withoutGlobalScope(ActiveScope::class)->orderBy('name', 'ASC')->get();

        $flash_sale = FlashSale::where('id', $id) // Kondisi where
            ->with(['flashSaleProduct.product']) // Tambahkan relasi dengan eager loading
            ->orderBy('name', 'ASC') // Urutkan berdasarkan nama
            ->first();
        // Initialize date_range as an empty string
        $date_range = '';

        // Check if both discount dates are set
        if (!empty($flash_sale->start_date) && !empty($flash_sale->end_date)) {
            // If both dates are present, combine them into a single string
            $date_range = $flash_sale->start_date . ' to ' . $flash_sale->end_date;
        }
        return view('backend.flash_sale.update', compact('products', 'flash_sale', 'date_range'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'slugs'  => 'required',
            'date'   => 'required',
            'image'  => 'nullable|required_if:name,true|image|mimes:jpeg,png,jpg|max:2048',
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
                // Mencari data Flash Sale yang ingin diupdate
                $flash_sale = FlashSale::findOrFail($id);
                // Cek apakah ada gambar yang di-upload
                if ($request->hasFile('image')) {

                    // Mendefinisikan path untuk gambar yang ada
                    $path_exist = 'storage/upload/image/flash_sale/' . $flash_sale->image;
                    $path_resize_exist = 'storage/upload/image/flash_sale/thumbnail/' . $flash_sale->image;

                    // Menghapus file gambar yang ada jika ada
                    if (File::exists($path_exist)) {
                        File::delete($path_exist);
                        File::delete($path_resize_exist);
                    }

                    $path = 'upload/image/flash_sale';
                    $pathResize = 'upload/image/flash_sale/thumbnail';

                    // Menggunakan service untuk meng-upload dan meresize gambar
                    $fileInfo = $this->imageUploadService->uploadAndResize(
                        $request->file('image'),
                        $path,
                        $pathResize
                    );

                    $flash_sale->image = $fileInfo['file_name'];
                    $flash_sale->ext = $fileInfo['file_extension'];
                    $flash_sale->size = $fileInfo['file_size'];
                }

                $dateRange = $request->input('date');
                // Memastikan bahwa dateRange tidak kosong
                if (empty($dateRange)) {
                    $startDate = null;
                    $endDate = null;
                } else {
                    [$startDate, $endDate] = explode(' to ', $dateRange);
                }

                // Update data Flash Sale
                $flash_sale->name = $request->name;
                $flash_sale->slug = $request->slugs;
                $flash_sale->start_date = $startDate;
                $flash_sale->end_date = $endDate;
                $flash_sale->updated_by = Auth::user()->id;
                $flash_sale->updated_at = now();

                // Simpan perubahan data Flash Sale
                $flash_sale->save();

                // Hapus produk lama yang terkait dengan Flash Sale ini
                FlashSaleProduct::where('flash_sale_id', $flash_sale->id)->delete();

                // Tambahkan produk baru ke dalam Flash Sale
                foreach ($request->product as $index => $product) {
                    // Create the ProductVariant
                    $flash_sale_product = new FlashSaleProduct([
                        'flash_sale_id' => $flash_sale->id,
                        'product_id' => $product,
                        'discount_price' => $request->discount[$index] ?? 0,
                        'discount_type' => $request->type[$index] ?? '',
                        'created_at' => now(),
                    ]);

                    // Save the variant
                    $flash_sale_product->save();
                }

                // Jika semua operasi sukses, commit transaksi
                DB::commit();

                return response()->json([
                    'status'   => 200,
                    'message'  => 'Updating flash sale data was successful!'
                ]);
            } catch (\Throwable $e) {
                // Jika terjadi kesalahan, rollback transaksi
                DB::rollback();
                return response()->json([
                    'status' => 500,
                    'message' => 'An error occurred while updating the flash sale.',
                    'error' => $e->getMessage(), // Tambahkan pesan error asli di sini
                ]);
            }
        }
    }

    public function change_active(Request $request)
    {
        $flash_sale = FlashSale::find($request->id);
        $flash_sale->update([
            'is_active' => $request->is_active,
            'updated_by' =>  Auth::user()->id,
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Published flash sale updated successfully!'
        ]);
    }

    public function change_feature(Request $request)
    {
        $flash_sale = FlashSale::find($request->id);
        $flash_sale->update([
            'is_feature' => $request->is_feature,
            'updated_by' =>  Auth::user()->id,
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Feature flash sale updated successfully!'
        ]);
    }

    public function destroy_selected(Request $request)
    {
        foreach ($request->id as $id) {
            $flash_sale = FlashSale::find($id);
            $flash_sale->update([
                'is_deleted' => 1,
                'deleted_by' =>  Auth::user()->id,
                'updated_at' =>  Carbon::now(),
            ]);
        }
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted flash sale data!'
        ]);
    }

    public function destroy_soft($id)
    {
        $flash_sale = FlashSale::find($id);
        $flash_sale->update([
            'is_deleted' => 1,
            'deleted_by' =>  Auth::user()->id,
            'updated_at' =>  Carbon::now(),
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted flash sale data!'
        ]);
    }
}
