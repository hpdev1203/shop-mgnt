<?php

namespace App\Livewire\Admin\Report;

use Livewire\Component;
use App\Models\Brand;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListReport extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $list_brand = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $brand_id = $this->list_brand[$key]['id'];
                $this->deleteReport($brand_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteReport($id){
        $brand = Brand::find($id);
        $brand->delete();
        session()->flash('success', 'Report deleted successfully');
    }

    public function handleDetele($id)
    {
        $this->deleteReport($id);
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $reports = Brand::paginate(10);
        }else{
            $reports = Brand::where('name', 'like', '%'.$this->search_input.'%')->orWhere('description', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        $this->list_brand = collect($reports->items());
        return view('livewire.admin.report.list-report', ['reports' => $reports]);
    }
}
