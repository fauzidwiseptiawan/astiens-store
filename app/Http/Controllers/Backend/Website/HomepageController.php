<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        return view('backend.homepage.index');
    }
}
