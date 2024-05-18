<?php

namespace App\Http\Controllers;
use App\Mail\MailerService;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public function sendMail( $type , $email , $subject ){
        Mail::to('ivanartista96@gmail.com')->send(new MailerService());
        return '';
    }
}
