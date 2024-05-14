<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AddSlider extends Component
{
    use WithFileUploads;
    public $photo;
    public $existedPhoto;
    public function render()
    {
        return view('livewire.admin.slider.add-slider');
    }
}
