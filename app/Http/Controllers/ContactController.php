<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:5',
        ]);

        $data = $request->only(['name', 'email', 'message']);

        Mail::to('Shumer0707@gmail.com')->send(new ContactMail($data));

        return response()->json(['message' => 'Сообщение успешно отправлено!']);
    }
}
