<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\AttributesValue;
use App\Models\Attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AttributesValueController extends Controller
{
    function index(Request $request)
    {
        $uri = $request->query('id');;
        $attributes = Attributes::where('is_active', '1')->orderBy('name', 'ASC')->get();
        return view('backend.attributes.attributes_value.index', compact('attributes', 'uri'));
    }

    function fetch($id)
    {
        // fetch attributes
        $attributes = AttributesValue::where('attributes_id', $id)->where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        // display result datatable
        return datatables()
            ->of($attributes)
            ->addIndexColumn()
            ->addColumn('select_all', function ($attributes) {
                return '<input type="checkbox" class="form-check-input select-form" id="select" name="select" value="' . $attributes->id . '">';
            })
            ->addColumn('attributes', function ($attributes) {
                return $attributes->attributes->name;
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
                'attributes_id'  => 'required',
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
            AttributesValue::create([
                'attributes_id' => $request->attributes_id,
                'name'       => $request->name,
                'created_by' =>  Auth::user()->id,
                'created_at' =>  now(),
            ]);
            return response()->json([
                'status'   => 200,
                'message'  => 'Adding attributes value data was successful!'
            ]);
        }
    }

    function show($id)
    {
        $attributes_value = AttributesValue::find($id);
        $attributes = Attributes::all();
        return response()->json([
            'status'       => 200,
            'message'      => 'Modal show!',
            'attributes_value'     => $attributes_value,
            'attributes'     => $attributes
        ]);
    }

    function update(Request $request, $id)
    {
        $attributes = AttributesValue::find($id);
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
        $attributes = AttributesValue::find($request->id);
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
            $attributes = AttributesValue::find($id);
            $attributes->update([
                'is_deleted' => '1',
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
        $attributes = AttributesValue::find($id);
        $attributes->update([
            'is_deleted' => '1',
            'deleted_by' =>  Auth::user()->id,
            'deleted_at' =>  Carbon::now(),
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted attributes data!'
        ]);
    }
}
