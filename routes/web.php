<?php
// web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('main');
});

Route::middleware(['check.login'])->group(function () {
    Route::get('/users/{user_name?}', [UserController::class, 'getUsers'])->name('users');
    Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('delete');
    Route::get('/users/settings', [UserController::class, 'settingsUser'])->name('settingsUser');
    Route::get('/send/{data}', [UserController::class, 'send']);
    Route::get('/send/{data}', [UserController::class, 'send']);
    Route::get('/user-registered', [UserController::class, 'user_registered']);
    Route::get('/sessions/{user_name?}/{session_status?}', [UserController::class, 'getSessions'])->name('sessions');
    Route::get('/form_request_credentials', [UserController::class, 'form_request_credentials'])->name('form_request_credentials');
});

Route::get('/login', function(){
    return view('main');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/users/create', [UserController::class, 'register']);
Route::post('/form_request_credentials/create', [UserController::class, 'request_credentials'])->name('request_credentials');
Route::post('/users/update/{id}', [UserController::class, 'update']);