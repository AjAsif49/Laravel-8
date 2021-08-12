<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    
    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.pages.contact.index', compact('contacts'));
    }

    public function AdminAddContact(){
        return view('admin.pages.contact.create');
    }

    public function AdminStoreContact(Request $request){
        Contact::insert([
            'email'=> $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('admin.pages.contact')->with('success', 'Contact Added Successfully');

    }

    public function EditContact($id){
        $contacts = Contact::find($id);
        return view('admin.pages.contact.edit', compact('contacts'));
    }

    public function UpdateContact(Request $request, $id){
        $update = Contact::find($id)->update([
            'email'=> $request->email,
            'phone' => $request->phone,
            'address' => $request->address,        ]);

        return Redirect()->route('admin.pages.contact')->with('success', 'Contact Updated Successfully');

    }

    public function DeleteContact($id){
        $delete = Contact::find($id)->Delete();
        return Redirect()->back()->with('success', 'Contact Deleted Successfully');

    }

}
