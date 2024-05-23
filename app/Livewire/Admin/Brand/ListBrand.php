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
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $brand_id = $this->list_brand[$key]['id'];
                $this->deleteBrand($brand_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteBrand($id){
        $checkProduct = Product::where('brand_id','=',$id)->first();
        if($checkProduct != null){
            $this->dispatch('error', ['error' => 'Danh Mục đã được đặt hàng, vì vậy không thể xóa.']);
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
