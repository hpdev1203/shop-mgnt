<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use App\Models\Brand;

class EditCategory extends Component
{
    use WithFileUploads;

    public $category_name = '';
    public $description = '';
    public $parent_category_id = null;
    public $id;
    public $photo;
    public $existedPhoto;

    public function updateCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categories,name,' . $this->id,
        ], [
            'category_name.required' => 'Tên danh mục là bắt buộc.',
            'category_name.unique' => 'Tên danh mục đã tồn tại.',
        ]);

        if ($this->photo) {
            $this->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ], [
                'photo.image' => 'File không phải là ảnh',
                'photo.mimes' => 'Ảnh không đúng định dạng',
                'photo.max' => 'Ảnh không được lớn hơn 2MB'
            ]);
            Storage::delete('public\\' . $this->existedPhoto);
            $photo_name = time() . '.' . $this->photo->extension();
            ImageOptimizer::optimize($this->photo->path());
            $this->photo->storeAs(path: "public\images\categories", name: $photo_name);
        }
        
        $category = Category::find($this->id);
        $category->name = $this->category_name;
        $category->description = $this->description;
        $category->slug = Str::of($this->category_name)->slug('-');
        $category->parent_id = $this->parent_category_id;
        if ($this->photo) {
            $category->image = $photo_name;
        }
        $category->save();

        session()->flash('message', 'Category has been updated successfully!');
        return redirect()->route('admin.categories');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $category = Category::find($this->id);
        $this->category_name = $category->name;
        $this->description = $category->description;
        $this->parent_category_id = $category->parent_id;
        if($category->image) {
            $this->existedPhoto = "images/categories/" . $category->image;
        }
        $this->brand_id = $category->brand_id;

        return view('livewire.admin.category.edit-category', ['categories' => $categories, 'brands' => $brands]);
    }
}
