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
    public $list_admin = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $user_id = $this->list_admin[$key]['id'];
                $this->deleteAdmin($user_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteAdmin($id){
        $admin = Administrator::find($id);
        $admin->delete();
        session()->flash('success', 'QTV đã được xóa thành công');
    }

    public function handleDetele($id)
    {
        $this->deleteAdmin($id);
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
        $this->list_admin = collect($administrators->items());
        return view('livewire.admin.administrator.list-administrator', ['administrators' => $administrators]);
    }
}
