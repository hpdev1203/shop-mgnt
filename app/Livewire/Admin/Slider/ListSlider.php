<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\Slide;

class ListSlider extends Component
{
    public function render()
    {
        $slides = Slide::paginate(10);
        return view('livewire.admin.slider.list-slider', compact('slides'));
    }
}
