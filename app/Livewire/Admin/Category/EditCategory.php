<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class EditCategory extends Component
{
    public $category_name = '';
    public $description = '';
    public $parent_category_id = '';
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $categories = Category::all();
        $category = Category::find($this->id);
        $this->category_name = $category->name;
        $this->description = $category->description;
        $this->parent_category_id = $category->parent_id;
        return view('livewire.admin.category.edit-category', ['categories' => $categories]);
    }

    public function updateCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categories,name,' . $this->id
        ]);

        $category = Category::find($this->id);
        $category->name = $this->category_name;
        $category->description = $this->description;
        $category->slug = Str::of($this->category_name)->slug('-');
        $category->parent_id = $this->parent_category_id;
        $category->save();

        session()->flash('message', 'Category has been updated successfully!');
    }
}
