<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUser;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.contact.list_contact');
    }

    public function edit($id)
    {
        $contact = ContactUser::find($id);
        return view('admin.dashboard.contact.edit_contact', ['contact' => $contact]);
    }
}
