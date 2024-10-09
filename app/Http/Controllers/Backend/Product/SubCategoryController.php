<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    function index()
    {
        $category = Category::where('is_active', '1')->orderBy('name', 'ASC')->get();
        return view('backend.sub_category.index', compact('category'));
    }

    function fetch()
    {
        // fetch category
        $sub_category = SubCategory::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        // display result datatable
        return datatables()
            ->of($sub_category)
            ->addIndexColumn()
            ->addColumn('select_all', function ($sub_category) {
                return '<input type="checkbox" class="form-check-input select-form" id="select" name="select" value="' . $sub_category->id . '">';
            })
            ->addColumn('category', function ($sub_category) {
                return $sub_category->category->name;
            })
            ->addColumn('publish', function ($sub_category) {
                if ($sub_category->is_active == 1) {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch" data-active="' . $sub_category->id . '" value"1" checked>
							<span class="slideon-slider"></span>
						</label>';
                } else {
                    return '<label class="slideon">
							<input type="checkbox" name="is_active" class="switch" data-active="' . $sub_category->id . '" value"0">
							<span class="slideon-slider"></span>
						</label>';
                }
            })
            ->addColumn('action', function ($sub_category) {
                return ' <div class="d-flex flex-wrap gap-2">
							<button type="button" id="show" value="' . $sub_category->id . '" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="warning-tooltip" data-bs-title="Edit" class="btn btn-circle btn-soft-warning btn-sm"><i class="ri-pencil-fill"></i></button>
                            <button type="button" id="destroySoft" value="' . $sub_category->id . '"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Delete" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-delete-bin-5-line"></i></button
					</div>';
            })
            ->rawColumns(['action', 'publish', 'category', 'select_all'])
            ->make(true);
    }

    function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'category_id'  => 'required',
                'name'         => 'required|unique:sub_category',
                'slug'         => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            // validation is successful it is saved to the database
            SubCategory::insert([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'created_by' =>  Auth::user()->id,
                'created_at' =>  now(),
            ]);
            return response()->json([
                'status'   => 200,
                'message'  => 'Adding sub category data was successful!'
            ]);
        }
    }

    function show($id)
    {
        $sub_category = SubCategory::find($id);
        $category = Category::all();
        return response()->json([
            'status'       => 200,
            'message'      => 'Modal show!',
            'sub_category' => $sub_category,
            'category'     => $category
        ]);
    }

    function update(Request $request, $id)
    {
        $sub_category = SubCategory::find($id);
        $validator = Validator::make($request->all(), [
            'category_id'  => 'required',
            'name' => 'required|unique:sub_category,name,' . $sub_category->id,
            'slug'         => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            // validation is successful it is saved to the database
            $sub_category->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'updated_by' =>  Auth::user()->id,
                'updated_at' =>  Carbon::now(),
            ]);
            return response()->json([
                'status'   => 200,
                'message'  => 'Update sub category data was successful!'
            ]);
        }
    }

    function change_active(Request $request)
    {
        $sub_category = SubCategory::find($request->id);
        $sub_category->update([
            'is_active' => $request->is_active,
            'updated_by' =>  Auth::user()->id,
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Published sub category updated successfully!'
        ]);
    }

    function destroy_selected(Request $request)
    {
        foreach ($request->id as $id) {
            $sub_category = SubCategory::find($id);
            $sub_category->update([
                'is_deleted' => '1',
                'deleted_by' =>  Auth::user()->id,
                'deleted_at' =>  Carbon::now(),
            ]);
        }
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted sub category data!'
        ]);
    }

    function destroy_soft($id)
    {
        $sub_category = SubCategory::find($id);
        $sub_category->update([
            'is_deleted' => '1',
            'deleted_by' =>  Auth::user()->id,
            'deleted_at' =>  Carbon::now(),
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted sub category data!'
        ]);
    }
}
