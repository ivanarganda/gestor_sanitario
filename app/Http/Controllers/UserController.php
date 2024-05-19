<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Session;
use \Illuminate\Database\QueryException;

use DateTime;

class UserController extends Controller
{
    //
    public function index(){
        return view('main');
    }

    public function register( Request $request){

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

            $json_data = [
                'type' => 'sendCredentials',
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];

            $this->registerUser($data);

            return redirect()->intended('/send/' . base64_encode(json_encode($json_data)) . '/');

        }

        return redirect()->back()->with(['error' => 'Could not be processed because user already registered']);

    }
    public function request_credentials( Request $request ){
        dd( $request );
        die();
    }

    public function user_registered(){

        return redirect()->intended('/users')->with(['success'=>'User registered successfully']);
        
    }

    public function update(Request $request, string $id)
    {

        try {

            $user = User::findOrFail($id);

            $user->update($request->all());
            
            $user->save();
            
            return redirect()->intended('/users')->with(['success'=>'Made changes succesfully']);

        } catch ( QueryException $e){

            if ( preg_match( '/Integrity constraint violation: 1062 Duplicate entry/' , $e->getMessage() ) ){
                return redirect()->back()->with(['error' => 'Not made changes due to another user with same email']);
            }

        }

    }

    public function delete(string $id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->intended('/users')->with(['success'=>'User deleted successfully']);
    }

    public function activateOrDeactivate(Request $request){
        $user = User::findOrFail($request->input('id'));
        $user->activated = $request->input('value_checkbox');
        $user->email_verified_at = null;
        if ( $request->input('value_checkbox') === '1' ){
            $user->email_verified_at = date('Y-m-d H:i:s');
        }
        $user->save();
        return response()->json([
            'user' => $user
        ]);
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

    public function send( $data ){
        return view( 'send' , ['data' => $data] );
    }

    public function getSessions(Request $request)
    {
        $query = DB::table('users as u')
            ->leftJoin('sessions as s', 'u.id', '=', 's.user_id')
            ->select('u.name as name', 's.ip_address as ip_address', 's.login_time as login_time', 's.logout_time as logout_time', 's.status as status');
    
        if ($request->filled('user_name')) {
            $query->where('u.name', 'like', '%' . $request->input('user_name') . '%');
        }
    
        if ($request->filled('session_status')) {
            $sessionStatus = $request->input('session_status');
            $query->where('s.status', $sessionStatus);
        }
    
        $users = $query->paginate(10);
        
        // Generate pagination data
        $pagination = $this->generatePagination($users);
    
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

    public function form_request_credentials(){
        return view('Pages.request-credentials');
    }
        
}
