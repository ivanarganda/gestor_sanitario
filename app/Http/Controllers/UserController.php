<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Session;
use DateTime;

class UserController extends Controller
{
    //
    public function index(){
        return view('main');
    }

    public function register( Request $request){

        DB::enableQueryLog();
        $user = User::where('email', $request->input('email'))->first();

        if ( $user === null ){
            $data = [
                'name' => $request->input('name'),
                'password' =>  base64_encode($request->input('password')),
                'email' => $request->input('email'),
                'created_at' => now(),
                'colegiate' => $request->input('colegiate'),
                'phone' => $request->input('phone'),
                'role' => $request->input('role'),
            ];

            $this->registerUser($data);

            return redirect()->back();
        }

        return back()->withErrors(['user' => 'Could not be processed because user already registered']);

        Log::info(DB::getQueryLog());

    }

    public function checkUser( Request $request){
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            return response()->json([
               'exist' => true,
                'user' => $user
            ]);
        }else{
            return response()->json([
               'exist' => false,
                'user' => $user
            ]);
        }
    }

    public function getSessions(Request $request)
    {
        DB::enableQueryLog();
        // Start building the query
        $query = User::query();

        // Apply filters based on request inputs
        if ($request->filled('user_name')) {
            $query->where('name', 'like', '%' . $request->input('user_name') . '%');
        }

        if ($request->filled('session_status')) {
            // Check the value of session_status for debugging
            $sessionStatus = $request->input('session_status');
            
            $query->whereHas('sessions', function ($q) use ($sessionStatus) {
                // Apply the session status filter 
                $q->where('status', $sessionStatus); 
            });
        }

        // Load the users with their sessions and paginate the results
        $users = $query->with('sessions')->paginate(5);

        Log::info(DB::getQueryLog());

        // Generate pagination data
        $pagination = $this->generatePagination($users);

        // Return the view with users and pagination data
        return view('Pages.log-users', compact('users', 'pagination'));
    }

    public function getUsers(Request $request){
        DB::enableQueryLog();
        // Start building the query
        $query = User::query();
        $users = $query->paginate(5);

        // Generate pagination data
        $pagination = $this->generatePagination($users);

        // Return the view with users and pagination data
        return view('Pages.gestion-usuarios', compact('users', 'pagination'));
    }
        
}
