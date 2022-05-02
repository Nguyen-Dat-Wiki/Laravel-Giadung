<?php

namespace App\Http\Services;


use Mail;


class MailService
{
    public function sendMail($request)
    {
        Mail::send('Client.Mail.mails', $data, function ($message)  {
            $message->to($request->input('email'),  $request->input('ten'));
            $message->bcc('john@johndoe.com', 'John Doe');
            $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject($request->input('subject'));
            $message->priority(3);
            $message->attach('pathToFile');
        });
    }
}