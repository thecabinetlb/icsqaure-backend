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
            'email' => 'required|email:rfc,dns',
            'company_name' => 'required',
            'phone' => 'required|numeric|digits_between:8,15', // Numeric and between 8 and 15 digits
            'subject' => ['required', Rule::in(['General Inquiries', 'Sales and Support'])],
            'message' => 'required',
        ],
        [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required',
            'email.email' => 'Please specify a real email',
            'company_name.required' => 'Company Name is required.',
            'phone.numeric' => 'Phone Number must contain only digits.',
            'phone.digits_between' => 'Phone Number must be between :min and :max digits long.',
            'subject.required' => 'Subject is required.',
            'subject.in' => 'Invalid subject. Please select either General Inquiries or Sales and Support.',
            'message.required' => 'Please enter your message.',
        ]);

        return Contact::create([
            'name' => request('name'),
            'email' => request('email'),
            'company_name' => request('company_name'),
            'phone' => request('phone'),
            'subject' => request('subject'),                
            'message' => request('message'),                
        ]);
    }
}
