<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;

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
        $slide = Slide::find($id);
        return view('admin.dashboard.slider.edit_slide',['slide' => $slide]);
    }
}
