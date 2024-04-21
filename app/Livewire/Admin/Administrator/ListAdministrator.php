<?php

namespace App\Livewire\Admin\Administrator;

use Livewire\Component;
use App\Models\Administrator;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListAdministrator extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $administrators = Administrator::find($id);
        $administrators->delete();
        session()->flash('success', 'Quản trị viên đã xóa thành công');
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $administrators = Administrator::where('role','administrator')->paginate(10);
        }else{
            $administrators = Administrator::where([
                ['role', '=', 'administrator'],
                ['name', 'like', '%'.$this->search_input.'%'],
            ])->paginate(10);
        }
        return view('livewire.admin.administrator.list-administrator', ['administrators' => $administrators]);
    }
}
