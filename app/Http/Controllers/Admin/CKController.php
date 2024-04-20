<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class CKController extends Controller
{
    public function uploadImage(Request $request)
    {
        $image = $request->file('upload');
        $image_name = time() . '.' . $image->extension();
        ImageOptimizer::optimize($image->path());
        $image->storeAs(path: "public\images\brands", name: $image_name);
        $url = asset('storage/images/brands/' . $image_name);
        return response()->json(['fileName' => $image_name, 'uploaded'=> 1, 'url' => $url]);
    }
}
