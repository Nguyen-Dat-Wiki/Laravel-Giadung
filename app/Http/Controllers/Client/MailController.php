<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $mailed = Mail::send('Client.Mail.mails', [
            'name'=>$request->input('name'),
            'content' =>$request->input('content'),
            'address' =>$request->input('address'),
            'phone' =>$request->input('phone'),
            'email' =>$request->input('email')
        ], function ($message) use($request) {
            $message->to('datanhem456@gmail.com',  $request->input('ten'));
            $message->from($request->input('email'));
            $message->subject($request->input('subject'));
        });
        return redirect('/');
        
    }
}
