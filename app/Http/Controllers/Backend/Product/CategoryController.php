<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        return view('backend.category.index');
    }

    public function fetch()
    {
        // fetch category
        $category = Category::withoutGlobalScope(ActiveScope::class)->orderBy('id', 'ASC')->get();
        // display result datatable
        return datatables()
            ->of($category)
            ->addIndexColumn()
            ->addColumn('select_all', function ($category) {
                return '<input type="checkbox" class="form-check-input select-form" id="select" name="select" value="' . $category->id . '">';
            })

            ->addColumn('image', function ($category) {
                if ($category != null && !empty($category->image)) {
                    return '<img src="' . asset('storage/upload/image/category/thumbnail/' . $category->image) . '" class="img-thumbnail" height="80" width="80" alt="' . asset('storage/upload/image/category/' . $category->image) . '">';
                } else {
                    return '<img src="https://placehold.co/400" class="img-thumbnail" height="80" width="80" alt="https://placehold.co/400">';
                }
            })
            ->addColumn('publish', function ($category) {
                if ($category->is_active == 1) {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch" data-active="' . $category->id . '" value"1" checked>
							<span class="slideon-slider"></span>
						</label>';
                } else {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch" data-active="' . $category->id . '" value"0">
							<span class="slideon-slider"></span>
						</label>';
                }
            })
            ->addColumn('action', function ($category) {
                return ' <div class="d-flex flex-wrap gap-2">
							<button type="button" id="show" value="' . $category->id . '" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="warning-tooltip" data-bs-title="Edit" class="btn btn-circle btn-soft-warning btn-sm"><i class="ri-pencil-fill"></i></button>
                            <button type="button" id="destroySoft" value="' . $category->id . '"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Delete" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-delete-bin-5-line"></i></button
					</div>';
            })
            ->rawColumns(['action', 'publish', 'image', 'select_all'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:category',
            'slug'  => 'required',
            'position'  => 'required',
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
                $path = 'upload/image/category';
                $pathResize = 'upload/image/category/thumbnail';

                // Menggunakan service untuk meng-upload dan meresize gambar
                $fileInfo = $this->imageUploadService->uploadAndResize(
                    $request->file('image'),
                    $path,
                    $pathResize
                );
                // validation is successful it is saved to the database
                Category::create([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'position_order' => $request->position,
                    'meta' => $request->keywords,
                    'meta_desc' => $request->desc,
                    'image' => $fileInfo['file_name'],
                    'ext' => $fileInfo['file_extension'],
                    'size' => $fileInfo['file_size'],
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);
                return response()->json([
                    'status'   => 200,
                    'message'  => 'Adding category data was successful!'
                ]);
            } else {
                return response()->json([
                    'status'   => 400,
                    'message'  => 'Failed to add category data!'
                ]);
            }
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        return response()->json([
            'status'   => 200,
            'message'  => 'Modal show!',
            'data'     => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:category,name,' . $category->id,
            'slug'  => 'required',
            'position'  => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            // Mendefinisikan path untuk gambar yang ada
            $path_exist = 'storage/upload/image/category/' . $category->image;
            $path_resize_exist = 'storage/upload/image/category/thumbnail/' . $category->image;

            // Menghapus file gambar yang ada jika ada
            if (File::exists($path_exist)) {
                File::delete($path_exist);
                File::delete($path_resize_exist);
            }
            // check if validate by adding image
            if (!$request->hasFile('image') == "") {
                // Mendefinisikan path untuk menyimpan gambar baru
                $path = 'upload/image/category';
                $path_resize = 'upload/image/category/thumbnail';

                // Menggunakan service untuk meng-upload dan meresize gambar baru
                $fileInfo = $this->imageUploadService->uploadAndResize(
                    $request->file('image'),
                    $path,
                    $path_resize
                );
                // validation is successful it is saved to the database
                $category->update([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'position_order' => $request->position,
                    'meta' => $request->keywords,
                    'meta_desc' => $request->desc,
                    'image' => $fileInfo['file_name'],
                    'ext' => $fileInfo['file_extension'],
                    'size' => $fileInfo['file_size'],
                    'updated_by' =>  Auth::user()->id,
                    'updated_at' =>  Carbon::now(),
                ]);
                return response()->json([
                    'status'   => 200,
                    'message'  => 'Update category data was successful!'
                ]);
            } else {
                $category->update([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'position_order' => $request->position,
                    'meta' => $request->keywords,
                    'meta_desc' => $request->desc,
                    'updated_by' =>  Auth::user()->id,
                    'updated_at' =>  Carbon::now(),
                ]);
                return response()->json([
                    'status'   => 200,
                    'message'  => 'Update category data was successful!'
                ]);
            }
        }
    }

    public function change_active(Request $request)
    {
        $category = Category::find($request->id);
        $category->update([
            'is_active' => $request->is_active,
            'updated_by' =>  Auth::user()->id,
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Published category updated successfully!'
        ]);
    }

    public function destroy_selected(Request $request)
    {
        foreach ($request->id as $id) {
            $category = Category::find($id);
            $category->update([
                'is_deleted' => 1,
                'deleted_by' =>  Auth::user()->id,
                'updated_at' =>  Carbon::now(),
            ]);
        }
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted category data!'
        ]);
    }

    public function destroy_soft($id)
    {
        $category = Category::find($id);
        $category->update([
            'is_deleted' => 1,
            'deleted_by' =>  Auth::user()->id,
            'updated_at' =>  Carbon::now(),
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted category data!'
        ]);
    }
}
