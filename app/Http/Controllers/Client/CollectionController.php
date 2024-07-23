<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CollectionController extends Controller
{
    public function index($slug)
    {   
        $category = Category::where('slug',$slug)->first();
        return view('client.collection', ['category' => $category]);
    }
}
