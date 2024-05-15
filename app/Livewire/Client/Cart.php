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
    public $CartItems = [];
    public $card_id;
    public $product_detail;
    public $product_size;
    public $total_amount = 0;
    public $update = []; 


    public function mount()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $this->load();
        
    }

    function load(){
        $this->Carts =  CartMD::where('user_id', '=', Auth::user()->id)->first();
 
        if($this->Carts != null &&  $this->Carts->cart_item != null){
            $this->CartItems = $this->Carts->cart_item;
            $this->total_amount = $this->Carts->cart_item->sum("total_amount");
        }
    }

    public function deleteCartItem($id){
        $cart_item = CartItem::find($id);
        $cart_item->delete();
        
    }

    public function handleDetele($id)
    {
        $this->deleteCartItem($id);
        $this->mount();
    }
  
    
    public function updated() {

        $this->dispatch('$refresh');
        //$this->load();
       
    }

    public function addQTY($id,$method,$value){
  
        $cart_item = CartItem::where('id', $id)->first();
        if($cart_item){
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
                //session()->flash('success', "Currency changed to");
                //return redirect(request()->header('Referer'));
            }
            
            $cart_item->total_amount = $cart_item->unit_price_at_time * $cart_item->quantity;
            $cart_item->save();
            //return redirect(request()->header('Referer'));

            // $this->dispatch('cartUpdated', $cart_item->count());
            // $this->render();

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
