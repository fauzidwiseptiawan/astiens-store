<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BrandController extends Controller
{
    function index()
    {
        return view('backend.brand.index');
    }

    function fetch()
    {
        // fetch brand
        $brand = Brand::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        // display result datatable
        return datatables()
            ->of($brand)
            ->addIndexColumn()
            ->addColumn('select_all', function ($brand) {
                return '<input type="checkbox" class="form-check-input select-form" id="select" name="select" value="' . $brand->id . '">';
            })
            ->addColumn('image', function ($brand) {
                if ($brand == '') {
                    return '<img src="' . asset('storage/upload/image/brand/thumbnail/' . $brand->image) . '" class="img-thumbnail" height="80" width="80" alt="' . asset('storage/upload/image/brand/' . $brand->image) . '">';
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
                $path_resize = 'upload/image/brand/thumbnail';
                $file = $request->file('image');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file_size = $file->getSize();
                $file_extension = $file->extension();
                $file->storeAs($path, $file_name, 'public');
                // resize image
                $manager = new ImageManager(new Driver());
                $resize_img = $manager->read($file);
                $resize_img->resize(300, 300)->save($file);
                $file->storeAs($path_resize, $file_name, 'public');
                // validation is successful it is saved to the database
                Brand::insert([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'image' => $file_name,
                    'ext' =>  $file_extension,
                    'size' =>  $file_size,
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
            // check if validate by adding image
            if (!$request->hasFile('image') == "") {
                $path_exist = 'storage/upload/image/brand/' . $brand->image;
                $path_resize_exist = 'storage/upload/image/brand/thumbnail/' . $brand->image;

                // check if there is an image file
                if (File::exists($path_exist)) {
                    File::delete($path_exist);
                    File::delete($path_resize_exist);
                }
                $path = 'upload/image/brand';
                $path_resize = 'upload/image/brand/thumbnail';
                $file = $request->file('image');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file_size = $file->getSize();
                $file_extension = $file->extension();
                $upload =  $file->storeAs($path, $file_name, 'public');
                // resize image
                $manager = new ImageManager(new Driver());
                $resize_img = $manager->read($file);
                $resize_img->resize(300, 300)->save($file);
                $upload = $file->storeAs($path_resize, $file_name, 'public');
                // validation is successful it is saved to the database
                if ($upload) {
                    $brand->update([
                        'name' => $request->name,
                        'slug' => $request->slug,
                        'image' => $file_name,
                        'ext' =>  $file_extension,
                        'size' =>  $file_size,
                        'updated_by' =>  Auth::user()->id,
                        'updated_at' =>  Carbon::now(),
                    ]);
                    return response()->json([
                        'status'   => 200,
                        'message'  => 'Update brand data was successful!'
                    ]);
                }
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
