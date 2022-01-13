<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request){
        $request->validate([
            'full_name' => 'required|string',
            'subject' => 'required',
            'email' => 'required|email:rfc,dns',
            'message' => 'required|string',
        ]);

        $body = $request->message;
        $data = [
            'full_name' => $request->full_name,
            'subject' => $request->subject,
            'email' => $request->email,
            'msg' => $request->message,
        ];
     
        Mail::send([], $data, function($message) use($request, $body){
            $message->from($request->email);
            $message->to('mohanad.ghalab@gmail.com');
            $message->subject($request->subject);
            $message->setBody($body);
        });
        return redirect('/');
    }
}
