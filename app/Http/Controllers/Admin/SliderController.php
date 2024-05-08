<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.index');
    }

    public function add()
    {
        return view('admin.slider.add');
    }

    public function edit($id)
    {
        return view('admin.slider.edit', compact('id'));
    }
}
