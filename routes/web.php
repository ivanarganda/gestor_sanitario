<?php
// web.php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('main');
});

Route::middleware(['check.login'])->group(function () {
    Route::get('/users/{s?}', [UserController::class, 'getUsers'])->name('users');
    Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('delete');
    Route::get('/users/settings', [UserController::class, 'settingsUser'])->name('settingsUser');
    Route::get('/send/{data}', [Controller::class, 'send']);
    Route::get('/send/{data}', [Controller::class, 'send']);
    Route::get('/user-registered/{error?}', [UserController::class, 'user_registered']);
    Route::get('/user-updated/{error?}', [UserController::class, 'user_updated']);
    Route::get('/request-created/{error?}', [NotificationController::class, 'request_created']);
    Route::get('/request-restaured/{error?}', [NotificationController::class, 'request_restaured']);
    Route::get('/request-recycled/{error?}', [NotificationController::class, 'request_recycled']);
    Route::get('/requestes-deleted/{error?}', [NotificationController::class, 'requestes_deleted']);
    Route::get('/requestes-restaured/{error?}', [NotificationController::class, 'requestes_restaured']);
    Route::get('/request-changed/{status}/{error}', [NotificationController::class, 'status_request_changed']);
    Route::get('/sessions/{s?}', [UserController::class, 'getSessions'])->name('sessions');
    Route::get('/form_request_credentials', [NotificationController::class, 'form_request_credentials'])->name('form_request_credentials');
    Route::get('/inbox/admin/{s?}', [NotificationController::class, 'getNotifications'])->name('inbox_admin');
    Route::get('/requestes/{s?}', [NotificationController::class, 'getMyRequestes'])->name('requestes');
    Route::get('/inbox/in/{id}', [NotificationController::class, 'getDetails']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/users/create', [UserController::class, 'register']);
Route::post('/form_request_credentials/create', [NotificationController::class, 'submit_request'])->name('submit_request');
Route::post('/users/update/{id}', [UserController::class, 'update']);