<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailerService extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = '';
        $subject = '';

        if ( $this->data->type == 'messageAboutChangesNotification' ){
            $view = 'Mail.message';
            $subject = 'Hola '.$this->data->destinatary.' tu solicitud esta en '.$this->data->status.'';
        }
        if ( $this->data->type == 'requestCredentials' ){
            $view = 'Mail.requestCredentials';
            $subject = 'Nueva Solicitud de '.$this->data->emisor.' para ' . $this->data->destinatary . ': '.$this->data->request_type;
        }
        if ( $this->data->type =='sendCredentials' ){
            $view = 'Mail.sendCredentials';
            $subject = 'Credenciales plataforma para el usuario ' . $this->data->email;
        }
        if ( $this->data->type == 'sendCredentialsUpdated' ){
            $view = 'Mail.sendCredentialsUpdated';
            $subject = 'Credenciales actualizadas de la plataforma para el usuario ' . $this->data->email;
        }

        return $this->view( $view ,[
            'data' => $this->data
        ])->from('igv.gestorsanitario@igvdeveloper.com')->subject( $subject );
    }
}
