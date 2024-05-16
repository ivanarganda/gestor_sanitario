<?php

namespace App\Http\Controllers;
use App\Mail\MailerService;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public function sendMail(){
        $details = [
            'title' => 'Correo de Prueba',
            'body' => 'Este es un correo de prueba enviado utilizando Gmail en Laravel.'
        ];
        Mail::to('ivanartista96@gmail.com')->send(new MailerService($details));

        return 'Correo enviado';
    }
}
