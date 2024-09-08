<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use Illuminate\support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(){
        $toEmail = 'mohamedgaber255255@gmail.com';
        $message = 'that is diabolical';
        $subject = "OPEN ME HUGHIE";
        Mail::to($toEmail)->send(new VerificationEmail($message , $subject));
    }
}
