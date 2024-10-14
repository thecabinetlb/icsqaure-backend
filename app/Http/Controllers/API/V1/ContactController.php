<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function index()
    {
        return Contact::all();
    }
    
    public function store()
    { 
        request()->validate([
            'title' => ['required', Rule::in(['Ms.', 'Mrs.','Mr.'])],
            'industry' => ['required', Rule::in(['Smart Cities', 'Food and Beverage'])],
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'company_name' => 'required',
            'phone' => 'required|numeric|digits_between:8,15', // Numeric and between 8 and 15 digits
            'country' => 'required',
            'city' => 'required',
            'message' => 'required'
        ],
        [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required',
            'email.email' => 'Please specify a real work email',
            'company_name.required' => 'Company Name is required.',
            'phone.numeric' => 'Phone Number must contain only digits.',
            'phone.digits_between' => 'Phone Number must be between :min and :max digits long.',
            'title.required' => 'Title is required.',
            'title.in' => 'Invalid title. Please select either Ms., Mrs., or Mr.',
            'industry.required' => 'Industry is required.',
            'industry.in' => 'Invalid industry. Please select either Smart Cities or Food and Beverage',
            'message.required' => 'Please enter your message.',
            'country.required' => 'Country is required.',
            'city.required' => 'City is required.'
       ]);

       Contact::create([
            'title' => request('title'),
            'name' => request('name'),
            'email' => request('email'),
            'company_name' => request('company_name'),
            'phone' => request('phone'),
            'industry' => request('industry'),                
            'city' => request('city'),                
            'country' => request('country'),                
            'message' => request('message'),                
        ]);
        
        $contact = [
            'title' => request('title'),
            'name' => request('name'),
            'email' => request('email'),
            'company_name' => request('company_name'),
            'phone' => request('phone'),
            'industry' => request('industry'),                
            'city' => request('city'),                
            'country' => request('country'),  
            'message' => request('message'),                
        ];

        try {
 
            Mail::to('marketing@aitsmena.com')->send(new ContactMessage($contact));
            return 'Contact Form Email sent successfully.';
        } catch (\Exception $e) {
            return 'Failed to send email: ' . $e->getMessage();
        }
    }
}
