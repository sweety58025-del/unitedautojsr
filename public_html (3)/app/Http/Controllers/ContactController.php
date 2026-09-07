<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Mail::to(config('mail.from.address'))->send(new ContactInquiry($validated));

        return back()->with('success', 'Thank you. Your message has been sent.');
    }
}
