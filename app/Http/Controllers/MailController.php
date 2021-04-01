<?php

namespace App\Http\Controllers;

use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public static function sendSignupEmail($name, $email, $verificationCode) 
    {
        $data= [
            'name' => $name,
            'verification_code' => $verificationCode
        ];

        return Mail::to($email)->send(new SignupEmail($data));

    }

}
