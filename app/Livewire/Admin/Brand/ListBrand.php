<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListBrand extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        session()->flash('success', 'Brand deleted successfully');
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $brands = Brand::paginate(10);
        }else{
            $brands = Brand::where('name', 'like', '%'.$this->search_input.'%')->orWhere('description', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        return view('livewire.admin.brand.list-brand', ['brands' => $brands]);
    }
}
