<?php

namespace App\Livewire\Admin\Contact;

use Livewire\Component;
use App\Models\ContactUser;

class EditContact extends Component
{
    public $id;
    public $view_contact = 0;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function updateContact(){
        $contact = ContactUser::find($this->id);
        if($this->view_contact == false){
            $this->view_contact = 0;
        }else{
            $this->view_contact = 1;
        }
        $contact->is_view = $this->view_contact;
        $contact->save();
        return redirect()->route('admin.contact');
    }

    public function render()
    {
        $contact = ContactUser::find($this->id);
        $this->view_contact = $contact->is_view;
        return view('livewire.admin.contact.edit-contact', ['contact' => $contact]);
    }
}
