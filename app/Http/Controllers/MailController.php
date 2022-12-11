<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function sendMail(Request $req){
        $email = $req->email;
        $name = $req->name;
        $subject = $req->subject;
        $messageText = $req->messageText;

        Mail::to($email)->cc('201880436@psu.palawan.edu.ph')->send(new SendEmail($email,$name,$subject,$messageText));

        return redirect('/#ContactUs');
    }
}
