<?php

namespace App\Livewire\Admin\Administrator;

use Livewire\Component;
use App\Models\User as Administrator;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ListAdministrator extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $isAdmin = 'n';

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
            $administrators = Administrator::where([
                ['role', '=', 'system'],
                ['is_super_admin', '=', '0'],
            ])->paginate(10);
        }else{
            $administrators = Administrator::where([
                ['role', '=', 'system'],
                ['name', 'like', '%'.$this->search_input.'%'],
                ['is_super_admin', '=', '0'],
            ])
            ->orWhere([
                ['role', '=', 'system'],
                ['email', 'like', '%'.$this->search_input.'%'],
                ['is_super_admin', '=', '0'],
            ])
            ->orWhere([
                ['role', '=', 'system'],
                ['phone', 'like', '%'.$this->search_input.'%'],
                ['is_super_admin', '=', '0'],
            ])
            ->paginate(10);
        }
        return view('livewire.admin.administrator.list-administrator', ['administrators' => $administrators]);
    }
}
