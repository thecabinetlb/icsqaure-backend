<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return Contact::all();
    }
    
    public function store()
    { 
        request()->validate([
            'name' => 'required',
            'company_name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|max:15',
            'message' => 'required',
        ],
        [
            'name.required' => 'Name is required.',
            'company_name.required' => 'Company Name is required.',
            'email.required' => 'Email is required',
            'email.email' => 'Please specify a real email',
            'phone.required' => 'Phone Number is required.',
            'message.required' => 'Please enter your message.',
        ]);

        return Contact::create([
            'name' => request('name'),
            'company_name' => request('company_name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'message' => request('message'),                
        ]);
    }
}
