<?php

namespace App\Http\Controllers;
use App\Mail\MailerService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Exceptions\MailException;

class MailController extends Controller
{
    //
    public function sendMail( Request $request ){

        $json_data = json_decode($request->input('data'));

        try {
            Mail::to( $json_data->email )->send(new MailerService($json_data));
            return response()->json([
                'type' => 'Success',
                'message' => 'Mail sent successfully'
            ]);
        } catch ( MailException $e) {
            return response()->json([
                'type' => 'Error',
                'message' => $e->getMessage()
            ]);
        }        
    }
}
