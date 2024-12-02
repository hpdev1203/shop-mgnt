<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\ProductDetail;
use App\Models\ProductSize;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Request;
use App\Models\CartMD;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Cart extends Component
{
    use WithPagination, WithoutUrlPagination; 
    
    public $search_input = '';
    public $list_product = [];
    public $selected_index = [];
    public $slug;
    public $Carts;
    public $CartItems = [];
    public $CartItems_detail = [];
    public $card_id;
    public $product_detail;
    public $product_size;
    public $total_amount = 0;
    public $update = []; 
    public $div_loading = "";
    public $on_saving = false;


    public $list_size = [];

    public function show_size($stt,$order_id,$product_id,$product_detail_id){
        $this->close_size();
        $this->list_size[$stt] = CartItem::where('cart_id',$order_id)
        ->where('product_id',$product_id)
        ->where('product_detail_id',$product_detail_id)
        ->orderBy('size_id', 'desc')->get();
    }

    public function close_size(){
        $this->list_size = [];
    }

    public function mount()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $this->load();
        
    }

    function load(){
        $start_time = time();
        $this->Carts =  CartMD::where('user_id', '=', Auth::user()->id)->first();
        if($this->Carts != null){
            if($this->Carts != null &&  $this->Carts->cart_item != null){
                $this->CartItems = $this->Carts->cart_item;
                $this->total_amount = $this->Carts->cart_item->sum("total_amount");
            }
            $this->CartItems = DB::select('
            SELECT prd.retail_price,prd_dt.id as product_detail_id,crt.product_id,prd_dt.title as dt_name,crt.product_id as id,prd.slug,crt.cart_id, prd.name, crt.warehouse_id ,sum(crt.quantity) as qty ,SUM(crt.total_amount) as total FROM cart_item crt INNER JOIN product_detail prd_dt on crt.product_detail_id = prd_dt.id INNER JOIN products prd on prd_dt.product_id = prd.id 
            WHERE crt.cart_id = '.$this->Carts->id.' 
            GROUP BY prd.retail_price,prd_dt.id,crt.product_id,prd_dt.title,prd.slug,crt.cart_id, prd.name,crt.warehouse_id,prd_dt.title;');
            
            $this->CartItems_detail = DB::select('
            SELECT crt.size_id, crt.product_id,crt.product_detail_id,SUM(crt.total_amount) as total,prd_dt.title as dt_name,crt.product_id as id,prd.slug,crt.cart_id, prd.name,sum(crt.quantity) as qty,prd_dt.retail_price, crt.warehouse_id
            FROM cart_item crt
            INNER JOIN product_detail prd_dt on crt.product_detail_id = prd_dt.id
            INNER JOIN products prd on prd_dt.product_id = prd.id
            WHERE crt.cart_id = '.$this->Carts->id.'
            GROUP BY crt.size_id, crt.product_id,crt.product_detail_id,prd_dt.title,prd.slug,crt.cart_id, prd.name,prd_dt.retail_price,crt.warehouse_id ');

        }
        



        // $results = DB::table('cart_item')
        // ->select('product_id', DB::raw('SUM(total_amount) as total'))
        // ->groupBy('product_id')
        // ->get();

        // $this->dispatch('hide_loading');
    }

    public function deleteCartItem($id,$product_id,$product_detail_id){
        $cart_item =  DB::select('
        DELETE 
        FROM cart_item 
        WHERE cart_id = '.$id.'
        AND product_id = '.$product_id.'
        AND product_detail_id = '.$product_detail_id);
        
    }

    public function handleDetele($id,$product_id,$product_detail_id)
    {
        $this->deleteCartItem($id,$product_id,$product_detail_id);
        $this->mount();
    }
  
    
    public function updated() {

        return redirect()->route('cart');
       
    }

   

    public function submit(){
      
        foreach($this->CartItems_detail as $item){
            $available_quantity = Warehouse::find($item->warehouse_id)->totalProductAvailable($item->product_id, $item->product_detail_id, $item->size_id);
       
            if($item->qty > $available_quantity){
                $this->dispatch('alertError', [$available_quantity]);
                return;
            }
        }

        if (count($this->CartItems) == 0) {
            $this->dispatch('successPayment', [
                'title' => 'Thất bại',
                'message' => 'Vui lòng chọn sản phẩm cho đơn hàng',
                'type' => 'error'
            ]);
            return;
        }else{
            return redirect()->route('payment');
        }
        
    }



    public function render()
    {
        return view('livewire.client.cart');
    }
}
