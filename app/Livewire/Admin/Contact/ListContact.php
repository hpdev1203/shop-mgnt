<?php

namespace App\Livewire\Admin\Contact;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\ContactUser;

class ListContact extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search_input = '';
    public $list_contacts = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $contact_id = $this->list_contacts[$key]['id'];
                $this->deleteContact($contact_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteContact($id){
        $contact = ContactUser::find($id);
        $contact->delete();
    }

    public function handleDetele($id)
    {
        $this->deleteContact($id);
        $this->render();
    }

    public function render()
    {
        $contacts = ContactUser::orderBy('created_at','desc')->paginate(10);
        if($this->search_input == ''){
            $contacts = ContactUser::orderBy('created_at','desc')->paginate(10);
        }else{
            $contacts = ContactUser::where('subject', 'like', '%'.$this->search_input.'%')->orderBy('created_at','desc')->paginate(10);
        }
        $this->list_contacts = collect($contacts->items());
        return view('livewire.admin.contact.list-contact',['contacts' => $contacts]);
    }
}
