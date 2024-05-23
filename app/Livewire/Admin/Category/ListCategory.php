<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListCategory extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $list_category = [];
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
                $category_id = $this->list_category[$key]['id'];
                $category = Category::find($category_id);
                $product = Product::where('category_id', $category_id)->first();
                if($product){
                    array_push($list_has_product, $category->name);
                }else{
                    $category->delete();
                }
            }
        }
        $this->selected_index = [];
        if(count($list_has_product) > 0){
            $list_has_product = implode(', ', $list_has_product);
            $this->dispatch('error', ['error' => 'Danh mục <b>'.$list_has_product.'</b> đã có sản phẩm, vì vậy không thể xóa.']);
        }
        $this->render();
    }

    public function deleteCategory($id){
        $category = Category::find($id);
        $product = Product::where('category_id', $id)->first();
        if($product){
            $this->dispatch('error', ['error' => 'Danh mục <b>'.$category->name.'</b> đã có sản phẩm, vì vậy không thể xóa.']);
        }else{
            $category->delete();
        }
    }

    public function handleDetele($id)
    {
        $this->deleteCategory($id);
        $this->render();
    }

    public function render()
    {
        if($this->search_input == ''){
            $categories = Category::paginate(10);
        }else{
            $categories = Category::where('name', 'like', '%'.$this->search_input.'%')->orWhere('description', 'like', '%'.$this->search_input.'%')->paginate(10);
        }

        $this->list_category = collect($categories->items());
        return view('livewire.admin.category.list-category', ['categories' => $categories]);
    }
}
