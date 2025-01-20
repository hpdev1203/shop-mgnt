<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListBrand extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $list_brand = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        $list_has_product = [];
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $brand_id = $this->list_brand[$key]['id'];
                $brand = Brand::find($brand_id);
                $checkProduct = Product::where('brand_id','=',$brand_id)->first();
                if($checkProduct != null){
                    array_push($list_has_product, $brand->name);
                }else{
                    $brand->delete();
                }
            }
        }
        $this->selected_index = [];
        if(count($list_has_product) > 0){
            $list_has_product = implode(', ', $list_has_product);
            $this->dispatch('error', ['error' => 'Nhãn hàng <b>'.$list_has_product.'</b> đã có sản phẩm, vì vậy không thể xóa.']);
        }
        $this->render();
    }

    public function deleteBrand($id){
        $brand = Brand::find($id);
        $checkProduct = Product::where('brand_id','=',$id)->first();
        if($checkProduct != null){
            $this->dispatch('error', ['error' => 'Nhãn hàng <b>'.$brand->name.'</b> đã có sản phẩm, vì vậy không thể xóa.']);
            return;
        }else{
            $brand = Brand::find($id);
            $brand->delete();
        }
       
    }

    public function handleDetele($id)
    {
        $this->deleteBrand($id);
        //$this->mount();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $brands = Brand::paginate(10);
        }else{
            $brands = Brand::where('name', 'like', '%'.$this->search_input.'%')->orWhere('description', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        $this->list_brand = collect($brands->items());
        return view('livewire.admin.brand.list-brand', ['brands' => $brands]);
    }
}
