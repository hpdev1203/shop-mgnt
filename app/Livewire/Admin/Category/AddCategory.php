<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AddCategory extends Component
{
    public $category_name = '';
    public $description = '';
    public $parent_category_id = '';

    public function storeCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categories,name'
        ]);

        $category = new Category();
        $category->name = $this->category_name;
        $category->description = $this->description;
        $category->slug = Str::of($this->category_name)->slug('-');
        $category->parent_id = $this->parent_category_id;
        $category->save();

        session()->flash('message', 'Category has been created successfully!');
        return redirect()->route('admin.categories');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.category.add-category', ['categories' => $categories]);
    }
}
