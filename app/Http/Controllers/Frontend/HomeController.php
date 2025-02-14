<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appearance;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.main');
    }

    public function get_appearance()
    {
        $appearance = Appearance::first();
        return response()->json([
            'status'   => 200,
            'data'     => $appearance,
        ]);
    }
}
