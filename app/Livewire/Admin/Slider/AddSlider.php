<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Slide;

class AddSlider extends Component
{
    use WithFileUploads;
    public $photo;
    public $existedPhoto;
    public $title;
    public $description;
    public $italic_text;
    public $button_text;
    public $link;
    public $status = 1;

    public function store()
    {
        $this->validate([
            'photo' => 'required|image|max:1024', // 1MB Max
            'title' => 'required',
        ], [
            'photo.image' => 'File không phải là ảnh.',
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'photo.max' => 'Ảnh không được lớn hơn 1MB.',
            'photo.required' => 'Vui lòng chọn ảnh.'
        ]);
        
        $imageName = time() . uniqid() . '.' . $this->photo->extension();
        $this->photo->storeAs(path: "public\images\slides", name: $imageName);

        $slider = new Slide();
        $slider->title = $this->title;
        $slider->description = $this->description;
        $slider->italic_text = $this->italic_text;
        $slider->button_text = $this->button_text;
        $slider->link = $this->link;
        $slider->image = $imageName;
        if($this->status == false){
            $this->status = 0;
        }else{
            $this->status = 1;
        }
        $slider->is_active = $this->status;
        $slider->save();
        return redirect()->route('admin.sliders');
    }

    public function render()
    {
        return view('livewire.admin.slider.add-slider');
    }
}
