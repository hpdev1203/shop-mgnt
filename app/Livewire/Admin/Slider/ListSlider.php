<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\Slide;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListSlider extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $list_slide = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $slide_id = $this->list_slide[$key]['id'];
                $this->deleteSlide($slide_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteSlide($id){
        $slide = Slide::find($id);
        $slide->delete();
       
    }

    public function handleDetele($id)
    {
        $this->deleteSlide($id);
        $this->render();
    }

    public function render()
    {
        $slides = Slide::paginate(10);
        $this->list_slide = collect($slides->items());
        return view('livewire.admin.slider.list-slider', compact('slides'));
    }
}
