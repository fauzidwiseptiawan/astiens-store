<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $brand = Brand::withoutGlobalScope(ActiveScope::class)->orderBy('name', 'ASC')->get();
        return view('frontend.home.main', compact('brand'));
    }
}
