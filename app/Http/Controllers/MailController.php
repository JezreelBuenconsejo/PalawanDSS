<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'messageText' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
        
        $email = $req->email;
        $name = $req->name;
        $subject = $req->subject;
        $messageText = $req->messageText;
        

        Mail::to($email)->cc('palawandsswaste@gmail.com')->send(new SendEmail($email,$name,$subject,$messageText));

        return redirect('/mailSent'.'#ContactUs')->with('alert','Thank you for sending a message to our team, expect a response within 24 to 48 hours via email \n \n You can also contact us on our phone support via call or text message at 0965-446-4832 (TM)');
    }
}
