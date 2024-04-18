<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListCategory extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('success', 'Category deleted successfully');
        $this->render();
    }

    public function render()
    {
        if($this->search_input == ''){
            $categories = Category::paginate(10);
        }else{
            $categories = Category::where('name', 'like', '%'.$this->search_input.'%')->orWhere('description', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        return view('livewire.admin.category.list-category', ['categories' => $categories]);
    }
}
