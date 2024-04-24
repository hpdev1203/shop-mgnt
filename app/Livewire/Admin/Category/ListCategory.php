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
    public $list_category = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $category_id = $this->list_category[$key]['id'];
                $this->deleteCategory($category_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        session()->flash('success', 'Category deleted successfully');
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
