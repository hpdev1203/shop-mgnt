<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\Users;
use Illuminate\Support\Str;

class AddUser extends Component
{
    public function render()
    {
        $users = User::all();
        return view('livewire.admin.user.add-user', ['user' => $users]);
    }
}
