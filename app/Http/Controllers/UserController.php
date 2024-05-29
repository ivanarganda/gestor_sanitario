<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Session;
use App\Models\Administrator;
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

            if ( $request->input('role') === 'staff' ){
                $data_user = User::where('email', $request->input('email'))->first();
                $admin = new Administrator();
                $admin->id = $data_user->id;
                $admin->name = $request->input('name');
                $admin->email = $request->input('email');
                $admin->save();
                $user = User::findOrFail($data_user->id);
                $user->activated = '1';
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->save();
            }

            return redirect()->intended('/send/' . base64_encode(json_encode($json_data)) . '/');

        }

        return redirect()->back()->with(['error' => 'Could not be processed because user already registered']);

    }

    public function user_registered( $error = null){

        if ( $error ) {
            return redirect()->intended('/users')->with(['error'=>'User registered successfully but issues forwarding credentials by email to user']);
        } else {
            return redirect()->intended('/users')->with(['success'=>'User registered successfully and sent credentials to user']);
        }
        
        
    }

    public function user_updated( $error = null){

        if ( $error ) {
            return redirect()->intended('/users')->with(['error'=>'User updated successfully but issues forwarding credentials by email to user']);
        } else {
            return redirect()->intended('/users')->with(['success'=>'User updated successfully and sent credentials to user']);
        }
        
    }

    public function update(Request $request, string $id)
    {
        try {
            // Fetch the user
            $user = User::findOrFail($id);

            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            // If the user is staff, manage the Administrator record
            if ($user->role == 'staff') {
                $admin = Administrator::firstOrNew(['id' => $id]);
                $admin->user_id = $id;
                $admin->name = $request->input('name');
                $admin->email = $request->input('email');
                $admin->save();

                // Update the user's activated status
                $user->activated = '1';
                $user->email_verified_at = now();
            }

            // Store previous data for comparison
            $previousData = $user->only(['name', 'email', 'password', 'role']);

            // Update user details
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->update($request->all());

            // Check for changes
            $dataChanged = [];
            foreach (['name', 'password', 'role'] as $field) {
                if ($previousData[$field] != $user->$field) {
                    $dataChanged[ucfirst($field)] = $user->$field;
                }
            }

            // Prepare data for redirection if changes are detected
            if (!empty($dataChanged)) {
                $json_data = [
                    'type' => 'sendCredentialsUpdated',
                    'dataUpdated' => $dataChanged,
                    'email' => $user->email,
                ];
                return redirect()->intended('/send/' . base64_encode(json_encode($json_data)) . '/');
            }

            return redirect()->intended('/users')->with(['success' => 'User updated successfully']);

        } catch (QueryException $e) {
            if (preg_match('/Integrity constraint violation: 1062 Duplicate entry/', $e->getMessage())) {
                return redirect()->back()->with(['error' => 'Not made changes due to another user with same email']);
            } else {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }


    public function delete(string $id){
        $user = User::findOrFail($id);

        if ( $user->role == 'staff' ){
            $admin = Administrator::findOrFail($id);
            $admin->delete();
        }

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

    public function getSessions( $s = null )
    {

        $sessions = $this->getSessions_view( $s );
    
        // Generate pagination data
        $pagination = $this->generatePagination($sessions);
    
        return view('Pages.log-users', [ 'sessions' => $sessions, 'pagination' => $pagination , 'search' => $s ]);
    }

    public function getUsers( $s = null ){
        
        DB::enableQueryLog();
        // Start building the query
        $users = $this->getUsers_view( $s );

        // Generate pagination data
        $pagination = $this->generatePagination($users);

        // Return the view with users and pagination data
        return view('Pages.gestion-usuarios', [ 'users' => $users, 'pagination' => $pagination , 'search' => $s ]);
    }

    public function saveSettings( Request $request , $id ){

        try {
            $user = User::findOrFail($id);

            $user->fill($request->all());
            $user->save();
            return redirect()->back()->with(['success' => 'Settings saved successfully']);
        } catch (QueryException $e) {
            if (preg_match('/Integrity constraint violation: 1062 Duplicate entry/', $e->getMessage())) {
                return redirect()->back()->with(['error' => 'Not settings saved due to another user with same email']);
            } else {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        
        }

    }

    public function settingsUser(){

        $data_user = User::where('email', Auth::user()->email)->first();

        return view('Pages.settings-user', compact('data_user'));
    }

    public function checkSession( Request $request ){

        $data = json_decode($request->input('data'));

        $session = true;

        $user = User::where('id', $data->sessionUserId)->first();

        if ( $user->role != $data->sessionUserRole ){
            $session = false;
        }   
    
        return response()->json(
            [
               'data_session' => $data,
               'session' => $session
            ]
        );
    }
        
}
