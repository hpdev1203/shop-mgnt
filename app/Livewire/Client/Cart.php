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
            SELECT crt.product_id,crt.product_detail_id,SUM(crt.total_amount) as total,prd_dt.title as dt_name,crt.product_id as id,prd.slug,crt.cart_id, prd.name,sum(crt.quantity) as qty,prd_dt.retail_price
            FROM cart_item crt
            INNER JOIN product_detail prd_dt on crt.product_detail_id = prd_dt.id
            INNER JOIN products prd on prd_dt.product_id = prd.id
            WHERE crt.cart_id = '.$this->Carts->id.'
            GROUP BY crt.product_id,crt.product_detail_id,prd_dt.title,prd.slug,crt.cart_id, prd.name,prd_dt.retail_price ');
        }
        



        // $results = DB::table('cart_item')
        // ->select('product_id', DB::raw('SUM(total_amount) as total'))
        // ->groupBy('product_id')
        // ->get();

        // $this->dispatch('hide_loading');
    }

    public function deleteCartItem($id){
        $cart_item =  DB::select('
        DELETE 
        FROM cart_item 
        WHERE cart_id = '.$this->Carts->id.'
        AND product_detail_id = '.$id);
        
    }

    public function handleDetele($id)
    {
        $this->deleteCartItem($id);
        $this->mount();
    }
  
    
    public function updated() {

        return redirect()->route('cart');
       
    }

    public function addQTY($id,$method,$value){
  
        $cart_item = CartItem::where('id', $id)->first();
        if($cart_item && $this->on_saving == false){
            $this->on_saving = true;
            $available_quantity = $cart_item->warehouse->totalProductAvailable($cart_item->product_id, $cart_item->product_detail_id, $cart_item->size_id);
          
            if($method == "plus"){
                $cart_item->quantity += 1;
            }elseif ($method == "minus"){
                $cart_item->quantity -= 1;
            }elseif ($method == "change"){
               
                if(is_numeric($value) == false){
                    $this->dispatch('successPayment', [
                        'title' => 'Thất bại',
                        'message' => 'Vui lòng nhập chữ số',
                        'type' => 'errorNum'
                    ]);
                    return;
                }else{
                    $cart_item->quantity =  $value;
                }
                
            }
            if($cart_item->quantity == 0){
                $this->handleDetele($id);
            }
            if($cart_item->quantity > $available_quantity){
                $this->dispatch('alertError', [$available_quantity]);
                return;
            }
            
            $cart_item->total_amount = $cart_item->unit_price_at_time * $cart_item->quantity;
            $cart_item->save();
            $this->updated();
        }
    }

    public function submit(){
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
