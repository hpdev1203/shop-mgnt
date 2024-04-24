<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListUser extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $list_user = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $user_id = $this->list_user[$key]['id'];
                $this->deleteUser($user_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        session()->flash('success', 'Khách hàng đã được xóa thành công');
    }

    public function handleDetele($id)
    {
        $this->deleteBrand($id);
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $users = User::where('role','customer')->paginate(10);
        }else{
            $users = User::where('role', '=', 'customer')->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search_input.'%')->orWhere('email', 'like', '%'.$this->search_input.'%')->orWhere('phone', 'like', '%'.$this->search_input.'%');
            })->paginate(10);
        }
        $this->list_user = collect($users->items());
        return view('livewire.admin.user.list-user', ['users' => $users]);
    }
}
