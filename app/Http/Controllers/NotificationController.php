<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\Requestnotification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    // Get notifications from admin panel for API
    public function getNotificationsAdmin( $id ){

        try {
            $notificatons = $this->getNotificationsByAdmin( $id );
            return response()->json([
                'notifications' => $notificatons,
                'success' => true,
                'message' => 'Notifications fetched successfully'
            ]);

        } catch ( QueryException $e ){

            Log::info( $e->getMessage(), LOG_DEBUG );
            return response()->json([
               'notifications' => -1,
               'success' => false,
               'message' => $e->getMessage()
            ]);
        }

    }

    // Get notifications from admin panel for view
    public function getNotifications(){

        try {

            $notifications = $this->getNotificationsByAdmin_view( Auth::user()->id );

            $pagination = $this->generatePagination( $notifications );

            return view('Pages.inbox' , compact( 'notifications' , 'pagination' ) );


        } catch ( QueryException $e ){

            Log::info( $e->getMessage(), LOG_DEBUG );
            return view('Pages.inbox')->with('error', $e->getMessage());

        }

    }

    public function getDetails( $id ){

        try {

            $notification = $this->getDetailsNotification( $id );

            // Change status
            $notify = Requestnotification::findOrFail( $id );
            $notify->viewed = '1';
            $notify->save();

            $user_email = User::where('id', $notification[0]->emisor )->first();

            $user_soliciter = $user_email->email;
            $user_admin = Auth::user()->email;

            return view('Pages.detailsNotification' , compact( 'notification' , 'user_soliciter' , 'user_admin' ) );


        } catch ( QueryException $e ){

            $notification = [];
            Log::info( $e->getMessage(), LOG_DEBUG );
            return view('Pages.detailsNotification' , compact( 'notification' ))->with('error', $e->getMessage());

        }

    }

    public function request_created( $error = null ){
        if ( $error ){
            return redirect()->intended('/form_request_credentials')->with('error', 'Problema al enviar el correo a tu administrador');
        }else {
            return redirect()->intended('/form_request_credentials')->with('success', 'Enviada la solicitud correctamente');
        }
    }

    public function status_request_changed( $status , $error ){
        if ( $error !== '' ){
            return redirect()->intended('/inbox')->with('error', 'Problema al avisar por email al usuario del estado de la solicitud');
        }else {
            return redirect()->intended('/inbox')->with('success', 'Cambiada la solicitud a '.$status.' corerctamente y avisar por email al usuario del estado del mismo');
        }
    }

    public function submit_request( Request $request ){

        try {
        
            $notification = Requestnotification::create($request->all());

            $destinataryEmail = User::where('id', $request->input('destinatary'))->first();
            $emisorEmail = User::where('id', $request->input('emisor'))->first();

            $json_data = [
                'type' => 'requestCredentials',
                'id' => $notification->id,
                'destinatary' => $destinataryEmail->email,
                'email' => $destinataryEmail->email,
                'request_type' => $request->input('request_type'),
                'title' => $request->input('title'),
                'emisor' => $emisorEmail->email,
                'description' => $request->input('description'),
            ];

            return redirect()->intended('/send/' . base64_encode(json_encode($json_data)) . '/');

        } catch ( QueryException $e ){

            Log::info( $e->getMessage(), LOG_DEBUG );
            return view('Pages.request-credentials')->with('error', $e->getMessage());

        }

    }

    public function activateOrDeactivate( Request $request ){
        try {

              $notification = Requestnotification::findOrFail( $request->input('request_id') );
              $notification->status = $request->input('status');
              $notification->save();

              return response()->json([
                 'success' => true,
                 'msg' => 'Successfully changed'
              ]);

        } catch ( QueryException $e ){

            Log::info( $e->getMessage(), LOG_DEBUG );
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
             ]);

        }
    }

    public function form_request_credentials(){

        $resultsAdmin = $this->getAdministratorsEmail();

        return view('Pages.request-credentials' , compact( 'resultsAdmin') );

    }
}
