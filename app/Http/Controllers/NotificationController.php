<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\Requestnotification;

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

            return view('Pages.detailsNotification' , compact( 'notification' ) );


        } catch ( QueryException $e ){

            $notification = [];

            return view('Pages.detailsNotification' , compact( 'notification' ))->with('error', $e->getMessage());

        }

    }
}
