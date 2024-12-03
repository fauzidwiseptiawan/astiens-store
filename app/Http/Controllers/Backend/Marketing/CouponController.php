<?php

namespace App\Http\Controllers\Backend\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupons::withoutGlobalScope(ActiveScope::class)->orderBy('code', 'ASC')->get();
        return view('backend.coupon.index', compact('coupon'));
    }

    public function fetch()
    {
        // fetch coupon
        // Perbarui status is_active berdasarkan end_date
        Coupons::withoutGlobalScope(ActiveScope::class)
            ->where('end_date', '<', now())
            ->update(['is_active' => 0]);

        // Fetch coupon data
        $coupon = Coupons::withoutGlobalScope(ActiveScope::class)
            ->orderBy('id', 'ASC')
            ->get();

        // display result datatable
        return datatables()
            ->of($coupon)
            ->addIndexColumn()
            ->addColumn('select_all', function ($coupon) {
                return '<input type="checkbox" class="form-check-input select-form" id="select" name="select" value="' . $coupon->id . '">';
            })
            ->addColumn('coupon', function ($coupon) {
                return $coupon->code;
            })
            ->addColumn('publish', function ($coupon) {
                if ($coupon->is_active == 1) {
                    return '<label class="slideon">
    						<input type="checkbox" name="is_active" class="switch" data-active="' . $coupon->id . '" value"1" checked>
    						<span class="slideon-slider"></span>
    					</label>';
                } else {
                    return '<label class="slideon">
    						<input type="checkbox" name="is_active" class="switch" data-active="' . $coupon->id . '" value"0">
    						<span class="slideon-slider"></span>
    					</label>';
                }
            })
            ->addColumn('action', function ($coupon) {
                return ' <div class="d-flex flex-wrap gap-2">
                           <button type="button" id="show" value="' . $coupon->id . '" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="warning-tooltip" data-bs-title="Edit" class="btn btn-circle btn-soft-warning btn-sm"><i class="ri-pencil-fill"></i></button>
                            <button type="button" id="destroySoft" value="' . $coupon->id . '"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Delete" class="btn btn-circle btn-soft-danger btn-sm"><i class="ri-delete-bin-5-line"></i></button
    				</div>';
            })
            ->rawColumns(['action', 'publish', 'coupon', 'select_all'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'type_coupon'   => 'required',
                'code'          => 'required|unique:coupons',
                'min_purchase'  => 'required',
                'discount'      => 'required',
                'type'          => 'required',
                'max_discount'  => 'required',
                'date'          => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            $dateRange = $request->input('date');
            // Memastikan bahwa dateRange tidak kosong
            if (empty($dateRange)) {
                $startDate = null;
                $endDate = null;
            } else {
                [$startDate, $endDate] = explode(' to ', $dateRange);
            }
            // validation is successful it is saved to the database
            Coupons::create([
                'type_coupon'       => $request->type_coupon,
                'code'              => $request->code,
                'min_purchase'      => $request->min_purchase,
                'discount_amount'   => $request->discount,
                'type'              => $request->type,
                'max_discount'      => $request->max_discount,
                'start_date'        => $startDate,
                'end_date'          => $endDate,
                'created_by'        => Auth::user()->id,
                'created_at'        => now(),
            ]);
            return response()->json([
                'status'   => 200,
                'message'  => 'Adding coupon data was successful!'
            ]);
        }
    }

    public function show($id)
    {
        $coupon = Coupons::select(['id', 'type_coupon', 'code', 'min_purchase', 'discount_amount', 'type', 'max_discount', 'start_date', 'end_date'])->find($id);

        // Initialize date_range as an empty string
        $date_range = '';

        // Check if both discount dates are set
        if (!empty($coupon->start_date) && !empty($coupon->end_date)) {
            // If both dates are present, combine them into a single string
            $date_range = $coupon->start_date . ' to ' . $coupon->end_date;
        }

        return response()->json([
            'status'       => 200,
            'message'      => 'Modal show!',
            'coupon'       => $coupon,
            'date_range'   => $date_range
        ]);
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupons::find($id);
        $validator = Validator::make($request->all(), [
            'type_coupon'   => 'required',
            'code'          => 'required|unique:coupons,code,' . $coupon->id,
            'min_purchase'  => 'required',
            'discount'      => 'required',
            'type'          => 'required',
            'max_discount'  => 'required',
            'date'          => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message' => $validator->errors()->toArray()
            ]);
        } else {
            $dateRange = $request->input('date');
            // Memastikan bahwa dateRange tidak kosong
            if (empty($dateRange)) {
                $startDate = null;
                $endDate = null;
            } else {
                [$startDate, $endDate] = explode(' to ', $dateRange);
            }
            // validation is successful it is saved to the database
            $coupon->update([
                'type_coupon'       => $request->type_coupon,
                'code'              => $request->code,
                'min_purchase'      => $request->min_purchase,
                'discount_amount'   => $request->discount,
                'type'              => $request->type,
                'max_discount'      => $request->max_discount,
                'start_date'        => $startDate,
                'end_date'          => $endDate,
                'updated_by'        =>  Auth::user()->id,
                'updated_at'        =>  Carbon::now(),
            ]);
            return response()->json([
                'status'   => 200,
                'message'  => 'Update coupon data was successful!'
            ]);
        }
    }

    public function change_active(Request $request)
    {
        $coupon = Coupons::find($request->id);
        $coupon->update([
            'is_active' => $request->is_active,
            'updated_by' =>  Auth::user()->id,
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Published coupon updated successfully!'
        ]);
    }

    public function destroy_selected(Request $request)
    {
        foreach ($request->id as $id) {
            $coupon = Coupons::find($id);
            $coupon->update([
                'is_deleted' => 1,
                'deleted_by' =>  Auth::user()->id,
                'deleted_at' =>  Carbon::now(),
            ]);
        }
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted coupon data!'
        ]);
    }

    public function destroy_soft($id)
    {
        $coupon = Coupons::find($id);
        $coupon->update([
            'is_deleted' => 1,
            'deleted_by' =>  Auth::user()->id,
            'deleted_at' =>  Carbon::now(),
        ]);
        return response()->json([
            'status'   => 200,
            'message'  => 'Successfully deleted coupon data!'
        ]);
    }
}
