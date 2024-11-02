<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Scopes\ActiveScope;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    function index()
    {
        return view('backend.brand.index');
    }

    function fetch()
    {
        // fetch brand
        $brand = Brand::withoutGlobalScope(ActiveScope::class)->get();
        // display result datatable
        return datatables()
            ->of($brand)
            ->addIndexColumn()
            ->addColumn('select_all', function ($brand) {
                return '<input type="checkbox" class="form-check-input select-form" id="select" name="select" value="' . $brand->id . '">';
            })
            ->addColumn('image', function ($brand) {
                if ($brand != null && !empty($brand->image)) {
                    return '<img src="' .  asset('storage/upload/image/brand/thumbnail/' . $brand->image) . '" class="img-thumbnail" height="80" width="80" alt="' . asset('storage/upload/image/brand/' . $brand->image) . '">';
                } else {
                    return '<img src="https://placehold.co/400" class="img-thumbnail" height="80" width="80" alt="https://placehold.co/400">';
                }
            })
            ->addColumn('publish', function ($brand) {
                if ($brand->is_active == 1) {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch" data-active="' . $brand->id . '" value"1" checked>
							<span class="slideon-slider"></span>
						</label>';
                } else {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch" data-active="' . $brand->id . '" value"0">
							<span class="slideon-slider"></span>
						</label>';
                }
            })
            ->addColumn('action', function ($brand) {
                return ' <div class="d-flex flex-wrap gap-2">
							<button type="button" id="show" value="' . $brand->id . '" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="warning-tooltip" data-bs-title="Edit" class="btn btn-circle btn-soft-warning btn-sm"><i class="ri-pencil-fill"></i></button>
                            <button type="button" id="destroySoft" value="' . $brand->id . '"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Delete" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-delete-bin-5-line"></i></button
					</div>';
            })
            ->rawColumns(['action', 'publish', 'image', 'select_all'])
            ->make(true);
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:brand',
            'slug'  => 'required',
            'image'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            // check if validate by adding image
            if (!$request->hasFile('image') == "") {
                $path = 'upload/image/brand';
                $pathResize = 'upload/image/brand/thumbnail';

                // Menggunakan service untuk meng-upload dan meresize gambar
                $fileInfo = $this->imageUploadService->uploadAndResize(
                    $request->file('image'),
                    $path,
                    $pathResize
                );
                // validation is successful it is saved to the database
                Brand::create([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'image' => $fileInfo['file_name'],
                    'ext' => $fileInfo['file_extension'],
                    'size' => $fileInfo['file_size'],
                    'created_by' =>  Auth::user()->id,
                    'created_at' =>  now(),
                ]);
                return response()->json([
                    'status'   => 200,
                    'message'  => 'Adding brand data was successful!'
                ]);
            } else {
                return response()->json([
                    'status'   => 400,
                    'message'  => 'Failed to add brand data!'
                ]);
            }
        }
    }

    function show($id)
    {
        $brand = Brand::find($id);
        return response()->json([
            'status'   => 200,
            'message'  => 'Modal show!',
            'data'     => $brand
        ]);
    }

    function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:brand,name,' . $brand->id,
            'slug'  => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            // Mendefinisikan path untuk gambar yang ada
            $path_exist = 'storage/upload/image/brand/' . $brand->image;
            $path_resize_exist = 'storage/upload/image/brand/thumbnail/' . $brand->image;

            // Menghapus file gambar yang ada jika ada
            if (File::exists($path_exist)) {
                File::delete($path_exist);
                File::delete($path_resize_exist);
            }
            // check if validate by adding image
            if (!$request->hasFile('image') == "") {
                // Mendefinisikan path untuk menyimpan gambar baru
                $path = 'upload/image/brand';
                $path_resize = 'upload/image/brand/thumbnail';

                // Menggunakan service untuk meng-upload dan meresize gambar baru
                $fileInfo = $this->imageUploadService->uploadAndResize(
                    $request->file('image'),
                    $path,
                    $path_resize
                );
                // validation is successful it is saved to the database Update data di database dengan gambar baru
                $brand->update([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'image' => $fileInfo['file_name'],
                    'ext' => $fileInfo['file_extension'],
                    'size' => $fileInfo['file_size'],
                    'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                ]);
                return response()->json([
                    'status'   => 200,
                    'message'  => 'Update brand data was successful!'
                ]);
                // check if validation is not by adding an image
            } else {
                $brand->update([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'updated_by' =>  Auth::user()->id,
                    'updated_at' =>  Carbon::now(),
                ]);
                return response()->json([
                    'status'   => 200,
                    'message'  => 'Update brand data was successful!'
                ]);
            }
            // Hapus cache terkait
            cache()->forget('cache_brand'); // Ini akan selalu terpanggil setelah update
        }
    }

    function change_active(Request $request)
    {
        $brand = Brand::find($request->id);
        $brand->update([
            'is_active' => $request->is_active,
            'updated_by' =>  Auth::user()->id,
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Published brand updated successfully!'
        ]);
    }

    function destroy_selected(Request $request)
    {
        foreach ($request->id as $id) {
            $brand = Brand::find($id);
            $brand->update([
                'is_deleted' => '1',
                'deleted_by' =>  Auth::user()->id,
                'updated_at' =>  Carbon::now(),
            ]);
        }
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted brand data!'
        ]);
    }

    function destroy_soft($id)
    {
        $brand = Brand::find($id);
        $brand->update([
            'is_deleted' => '1',
            'deleted_by' =>  Auth::user()->id,
            'updated_at' =>  Carbon::now(),
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted brand data!'
        ]);
    }
}
