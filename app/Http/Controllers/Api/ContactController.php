<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Mail\NewContactReceived;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required'|'email',
            'message' => 'required'|'max:500'
        ]);

        $newContact = new Contact();

        $newContact->name = $data["name"];
        $newContact->email = $data["email"];
        $newContact->message = $data["message"];

        $newContact->save();

        // mando un email di conferma all'utente new contact
        Mail::to($data['email'])->send(new NewContact($data));
        // mando un email di notifica di un new contact a me stesso
        Mail::to('acolombo0911@gmail.com')->send(new NewContactReceived($data));

        return response()->json([
            'message' => "Thanks for {$data['name']} your message. We will be in touch soon."
        ], 201);
    }
}
