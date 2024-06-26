<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Database\QueryException;

class ChatController extends Controller
{
    public function contacted_with_administrator( $error = null ){
        if ( $error ){
            return redirect()->intended('/requestes')->with('error', 'Error al contactar con el administrador');
        }else {
            return redirect()->intended('/requestes')->with('success', 'Contactado correctamente');
        }
    }

    public function createchat( Request $request ){

        $data = json_decode($request->input('data'));

        $title = $data->title;
        $message = $data->message;
        $destinatary = $data->receptor;
        $emisor = $data->emisor;
        $request_id = $data->request_id;

        $json_data = [
            'title' => $title,
            'message' => $message,
            'emisor' => $emisor,
            'destinatary' => $destinatary,
            'request_id' => $request_id,
            'created_at' => now()
        ];

        $this->sendMessage( $json_data );

        return response()->json([
            'success' => $json_data,
            'msg' => 'Successfully changed'
         ]);

    }

    public function generateChatList(  $id = null ){

        $results = $this->getChatList(Auth::user()->id,Auth::user()->role);
        return response()->json([
            'data' => $results,
            'msg' => 'Successfully changed'
        ]);
    }

    public function generateChatRoom( $destinary ){

        $results = $this->getChatRoom(Auth::user()->id, $destinary);

        return response()->json([
            'data' => $results,
            'msg' => 'Successfully created'
        ]);
    }

    public function getNotificationsNewMessages( $id ){
        try {
            $notificatons = $this->getNotificationsNewMessages_api( $id );
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

    public function setAsViewed( Request $request ){
        DB::table('chatnotificationsrequest')
        ->where('viewed', '0')
        ->where('emisor', $request->input('destinatary'))
        ->where('destinatary', Auth::user()->id)
        ->update(['viewed' => '1']);
        return response()->json([
           'msg' => 'Successfully set'
        ]);
    }
}
