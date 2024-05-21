<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\Slide;
use Livewire\WithFileUploads;

class EditSlider extends Component
{
    use WithFileUploads;
    public $id;
    public $photo;
    public $existedPhoto;
    public $title;
    public $description;
    public $italic_text;
    public $button_text;
    public $link;
    public $status = 1;

    public function updateSlide()
    {
        $this->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
        ]);

        if ($this->photo) {
            $this->validate([
                'photo' => 'image|max:1024', // 1MB Max
            ], [
                'photo.image' => 'File không phải là ảnh.',
                'photo.max' => 'Ảnh không được lớn hơn 1MB.'
            ]);
            
            $imageName = time() . uniqid() . '.' . $this->photo->extension();
            $this->photo->storeAs(path: "public\images\slides", name: $imageName); 
        }

        $slider = Slide::find($this->id);
        $slider->title = $this->title;
        $slider->description = $this->description;
        $slider->italic_text = $this->italic_text;
        $slider->button_text = $this->button_text;
        $slider->link = $this->link;
        if ($this->photo) {
            $slider->image = $imageName;
        }
        if($this->status == false){
            $this->status = 0;
        }else{
            $this->status = 1;
        }
        $slider->is_active = $this->status;
        $slider->save();
        return redirect()->route('admin.sliders');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $slide = Slide::find($this->id);
        $this->title = $slide->title;
        $this->description = $slide->description;
        $this->italic_text = $slide->italic_text;
        $this->button_text = $slide->button_text;
        $this->link = $slide->link;
        if($slide->image){
            $this->existedPhoto = "images/slides/" . $slide->image;
        }
        $this->status = $slide->is_active;
        return view('livewire.admin.slider.edit-slider');
    }
}
