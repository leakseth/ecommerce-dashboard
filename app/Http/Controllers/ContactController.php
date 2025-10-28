<?php

namespace App\Http\Controllers;

use App\Mail\ContactAutoReply;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('components.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Save message to database
        $contact = Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        $adminEmail = 'suyp8944@gmail.com';

        try {
            // Send email to admin
            Mail::to($adminEmail)->send(new ContactMail($data));
            session()->flash('success_admin', 'Admin has received your message.');

            // Send auto-reply email to user
            Mail::to($request->email)->send(new ContactAutoReply($request->name));
            session()->flash('success_user', 'You have received an auto-reply email.');

            return back();
        } catch (\Exception $e) {
            Log::error('Mail error: '.$e->getMessage());
            return back()->with('error', 'Your message was saved, but we could not send email. Please try again later.');
        }

    }



}
