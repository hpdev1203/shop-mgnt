<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ContactUser;

class Contact extends Component
{
    public $name_contact = "";
    public $email_contact = "";
    public $subject_contact = "";
    public $content_contact = "";

    public function contact()
    {
        $this->validate([
            'subject_contact' => 'required',
            'content_contact' => 'required',
        ], [
            'subject_contact.required' => 'Vui lòng nhập tiêu đề liên hệ.',
            'content_contact.required' => 'Vui lòng nhập nội dung liên hệ.',
        ]);

        $contact = new ContactUser();
        $contact->user_id = Auth::user()->id;
        $contact->subject = $this->subject_contact;
        $contact->description = $this->content_contact;
        $contact->save();

        $this->dispatch('successContact', [
            'title' => 'Thành công',
            'message' => 'Đã gửi liên hệ thành công',
            'type' => 'success'
        ]);
    }

    public function render()
    {
        $user = User::find(Auth::user()->id);
        $this->name_contact = $user->name;
        $this->email_contact = $user->email;
        return view('livewire.client.contact');
    }
}
