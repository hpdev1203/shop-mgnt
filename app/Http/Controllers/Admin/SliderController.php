<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.slider.index');
    }

    public function add()
    {
        return view('admin.dashboard.slider.add_slide');
    }

    public function edit($id)
    {
        return view('admin.dashboard.slider.edit', compact('id'));
    }
}
