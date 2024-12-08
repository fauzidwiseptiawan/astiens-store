<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\SliderGroups;

class HomepageController extends Controller
{
    public function index()
    {
        $sliderGroups = SliderGroups::with('sliderItems')->orderBy('order', 'asc')->get();
        return view('backend.homepage.index', compact('sliderGroups'));
    }

    public function save_home_slider($id)
    {
        // // Ambil slider group berdasarkan ID beserta slider items-nya
        // $sliderGroup = SliderGroups::with('sliderItems')->findOrFail($id);

        // return response()->json($sliderGroup);
    }
}
