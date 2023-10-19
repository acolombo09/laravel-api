<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        return response()->json([
            'message' => "Thanks for {$data['name']} your message. We will be in touch soon."
        ], 201);
    }
}
