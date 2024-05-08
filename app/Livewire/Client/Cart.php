<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\ProductDetail;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Request;
use App\Models\CartMD;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;


class Cart extends Component
{
    use WithPagination, WithoutUrlPagination; 
    
    public $search_input = '';
    public $list_product = [];
    public $selected_index = [];
    public $slug;
    public $Carts;
    public $CartItems;
    public $card_id;

    public function mount()
    {
        $this->Carts =  CartMD::where('user_id', '=', Auth::user()->id)->first();
        $this->CartItems = $this->Carts->cart_item;

        //$CartItem = CartItem::all();
        //$Product = Product::all();
        //$this->product = Product::find($id);
        // $this->product_route = route('product-detail', ['id' => $id, 'slug' => $this->product->slug]);
        // $this->product_details = $this->product->productDetails;
        // $this->product_sizes = $this->product->productSizes;
        // $this->product_warehouses = $this->product->warehouses();
        // $this->warehouse_selected = $this->product_warehouses->first();
        // if($this->warehouse_selected){
        //     $this->warehouse_id_selected = $this->warehouse_selected->id;
        // }
        // $this->product_detail_selected = $this->product_details->first();
        // $this->product_detail_id_selected = $this->product_detail_selected->id;
        // $this->product_size_selected = $this->product->productSizes->first();
        // if($this->product_size_selected){
        //     $this->product_size_id_selected = $this->product_size_selected->id;
        // }
        // $this->updateProductDetailImage();
        // $this->updateAvailableQuantity();
    }


    public function render()
    {
        // Get the last segment of the URL
        // $slug = last(array_filter(Request::segments()));
        // $category = Category::where('slug', '=', $slug )->first();
        // $products = Product::where('category_id', '=', $category->id)->paginate(8);
       
 
      
        return view('livewire.client.cart');
    }
}
