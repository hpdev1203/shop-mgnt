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

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $users = User::find($id);
        $users->delete();
        session()->flash('success', 'Khách hàng đã xóa thành công');
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $users = User::where('role','user')->paginate(10);
        }else{
            $users = User::where([
                ['role', '=', 'user'],
                ['name', 'like', '%'.$this->search_input.'%'],
            ])->paginate(10);
        }
        return view('livewire.admin.user.list-user', ['users' => $users]);
    }
}
