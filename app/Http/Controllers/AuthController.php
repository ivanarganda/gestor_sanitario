<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function index(){
        return view('Form.login');
    }
    
    public function login(Request $request)
    {

        try {

            // Validation rules for email and password
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'password' => 'required',
            ]);

            // If validation fails, return back with errors  
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Retrieve user based on access type
            $user = User::where('email', $request->email)->first();

            if (!$user){
                return back()->withErrors(['email' => 'User does not exist']);
            }

            // Let´s gonna check wether session gone wrong or success
            $logged = true;
            $errorMessage = '';
            $type = '';

            // Check if password matches
                if ($user->password === base64_encode($request->password)) {
                
                    // Check access type and roles
                    if ($request->access == 'admin' && $user->role != 'staff') {
                        $type = 'user';
                        $errorMessage = 'Dennied access only for administrators';
                        $logged = false;
                        
                    } 
                    if ($request->access == 'medats' && ( $user->role == 'staff' || $user->role == 'user')) {
                        $type = 'user';
                        $errorMessage = 'Dennied access only for medical or ats';
                        $logged = false;
                    }
                    // Check if user is activated and email is verified
                    if ($user->activated != '1' || $user->email_verified_at == null) {
                        $type = 'user';
                        $errorMessage = 'Not user activated, please, contact with administrator';
                        $logged = false;
                    }

                } else {

                    $logged = false;
                    $errorMessage = 'Log in fail due to incorrect credentials';
                    $type = 'email';

                }

                // Get the ip address of the user
                $ipAddress = $request->ip();
                // Get the session id of user
                $sessionId = $request->session()->getId();


                if ( !$logged ){

                    $this->registerSession([
                        'ip_address' => $ipAddress,
                        'user_agent' => $sessionId,
                        'login_time' => null,
                        'logout_time' => null,
                        'user_id' => $user->id,
                        'status' => '0'
                    ]);

                    return back()->withErrors([$type => $errorMessage]);

                } else {

                    // Log in the user
                    Auth::login($user,true);

                    $user = Auth::user();

                    $user->session_id = $sessionId;

                    $user->save();
                    // Login time
                    $loginTime = date('Y-m-d H:i:s');

                    // Insert login details into the database

                    $this->registerSession([
                        'ip_address' => $ipAddress,
                        'user_agent' => $sessionId,
                        'login_time' => $loginTime,
                        'logout_time' => null,
                        'user_id' => $user->id,
                        'status' => '1'
                    ]);

                    return redirect()->intended('/');

                }
            } catch (\Exception $e) {
                return back()->withErrors(['email' => 'Error on log in. Try it later']);
            }
        
    }

    public function logout()
    {
        DB::table('sessions')->where('user_agent', Auth::user()->session_id)
       ->update(['logout_time' => now()]);
        Auth::logout();
        return redirect()->intended('/');
    }

}
