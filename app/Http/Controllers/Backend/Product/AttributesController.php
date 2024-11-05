<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AttributesController extends Controller
{
    function index()
    {
        $attributes = Attributes::withoutGlobalScope(ActiveScope::class)->orderBy('name', 'ASC')->get();
        return view('backend.attributes.index', compact('attributes'));
    }

    function fetch()
    {
        // fetch attributes
        $attributes = Attributes::withoutGlobalScope(ActiveScope::class)->orderBy('id', 'ASC')->get();
        // display result datatable
        return datatables()
            ->of($attributes)
            ->addIndexColumn()
            ->addColumn('select_all', function ($attributes) {
                return '<input type="checkbox" class="form-check-input select-form" id="select" name="select" value="' . $attributes->id . '">';
            })
            ->addColumn('attributes', function ($attributes) {
                return $attributes->name;
            })
            ->addColumn('publish', function ($attributes) {
                if ($attributes->is_active == 1) {
                    return '<label class="slideon">
    						<input type="checkbox" name="is_active" class="switch" data-active="' . $attributes->id . '" value"1" checked>
    						<span class="slideon-slider"></span>
    					</label>';
                } else {
                    return '<label class="slideon">
    						<input type="checkbox" name="is_active" class="switch" data-active="' . $attributes->id . '" value"0">
    						<span class="slideon-slider"></span>
    					</label>';
                }
            })
            ->addColumn('action', function ($attributes) {
                return ' <div class="d-flex flex-wrap gap-2">
                            <a href="' . route('attributes-value.index', ['id' => $attributes->id]) . '">
    						    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="success-tooltip" data-bs-title="Value" class="btn btn-circle btn-soft-success btn-sm"><i class="ri-eye-fill"></i></button>
                            </a>
    						<button type="button" id="show" value="' . $attributes->id . '" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="warning-tooltip" data-bs-title="Edit" class="btn btn-circle btn-soft-warning btn-sm"><i class="ri-pencil-fill"></i></button>
                            <button type="button" id="destroySoft" value="' . $attributes->id . '"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Delete" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-delete-bin-5-line"></i></button
    				</div>';
            })
            ->rawColumns(['action', 'publish', 'attributes', 'select_all'])
            ->make(true);
    }

    function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'         => 'required|unique:attributes',
            ],
        );
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            // validation is successful it is saved to the database
            Attributes::create([
                'name'       => $request->name,
                'created_by' =>  Auth::user()->id,
                'created_at' =>  now(),
            ]);
            return response()->json([
                'status'   => 200,
                'message'  => 'Adding attributes data was successful!'
            ]);
        }
    }

    function show($id)
    {
        $attributes = Attributes::find($id);
        return response()->json([
            'status'       => 200,
            'message'      => 'Modal show!',
            'attributes'     => $attributes
        ]);
    }

    function update(Request $request, $id)
    {
        $attributes = Attributes::find($id);
        $validator = Validator::make($request->all(), [
            'attributes_id'  => 'required',
            'name'           => 'required|unique:attributes,name,' . $attributes->id,
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            // validation is successful it is saved to the database
            $attributes->update([
                'name' => $request->name,
                'updated_by' =>  Auth::user()->id,
                'updated_at' =>  Carbon::now(),
            ]);
            return response()->json([
                'status'   => 200,
                'message'  => 'Update attributes data was successful!'
            ]);
        }
    }

    function change_active(Request $request)
    {
        $attributes = Attributes::find($request->id);
        $attributes->update([
            'is_active' => $request->is_active,
            'updated_by' =>  Auth::user()->id,
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Published attributes updated successfully!'
        ]);
    }

    function destroy_selected(Request $request)
    {
        foreach ($request->id as $id) {
            $attributes = Attributes::find($id);
            $attributes->update([
                'is_deleted' => 1,
                'deleted_by' =>  Auth::user()->id,
                'deleted_at' =>  Carbon::now(),
            ]);
        }
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted attributes data!'
        ]);
    }

    function destroy_soft($id)
    {
        $attributes = Attributes::find($id);
        $attributes->update([
            'is_deleted' => 1,
            'deleted_by' =>  Auth::user()->id,
            'deleted_at' =>  Carbon::now(),
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted attributes data!'
        ]);
    }
}
