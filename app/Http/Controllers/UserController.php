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

            return redirect()->back()->with(['user'=>'Usuario registrado correctamente']);;
        }

        return back()->withErrors(['user' => 'Could not be processed because user already registered']);

    }

    public function update(Request $request, string $id)
    {

        $user = User::findOrFail($id);

        $user->update($request->all());
        
        $user->save();

        return redirect()->intended('/users/')->with(['user'=>'Cambios realizados correctamente']);

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
        
}
