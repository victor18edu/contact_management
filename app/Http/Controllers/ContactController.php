<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $recordsPerPage = request()->input('recordsPerPage', 5);
        $contacts = Contact::paginate($recordsPerPage);
        return view('contacts.index', compact('contacts', 'recordsPerPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:6',
            'contact' => 'required|digits:9|unique:contacts',
            'email' => 'required|email|unique:contacts',
        ]);
    
        $contact = new Contact();
        $contact->name = $validate['name'];
        $contact->contact = $validate['contact'];
        $contact->email = $validate['email'];
        $contact->save();
    
        return redirect()->route('contacts.index')->with('success', __('Contact created successfully!'));
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validate = $request->validate([
            'name' => 'required|min:6',
            'contact' => 'required|digits:9|unique:contacts,contact,' . $contact->id,
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
        ]);
    
        $contact->name = $validate['name'];
        $contact->contact = $validate['contact'];
        $contact->email = $validate['email'];
        $contact->save();
    
        return redirect()->route('contacts.index')->with('success', 'Contact changed successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact successfully deleted!');
    
    }
}
