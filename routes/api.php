<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WindowSizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/notifications/{id}', [NotificationController::class, 'getNotificationsAdmin'])->middleware('notification');
Route::post('/checkSession', [UserController::class, 'checkSession']);
Route::post('/sendEmail', [MailController::class, 'sendMail']);
Route::post('/users', [UserController::class, 'checkUser']);
Route::post('/users/changeStatus', [UserController::class, 'activateOrDeactivate']);
Route::post('/inbox/changeStatus', [NotificationController::class, 'activateOrDeactivate']);
Route::post('/inbox/restaure', [NotificationController::class, 'restaure']);
Route::post('/inbox/recycle', [NotificationController::class, 'recycle']);
Route::post('/inbox/multipledelete', [NotificationController::class, 'multipledelete']);
Route::post('/inbox/multiplerestaure', [NotificationController::class, 'multiplerestaure']);
Route::post('/myinbox/chat/create', [ChatController::class, 'createchat']);
Route::get('/requestes/chat/in/{id?}', [ChatController::class, 'generateChatList']);
Route::get('/requestes/chatroom/in/{id?}', [ChatController::class, 'generateChatRoom']);
Route::post('/chatroom/idx/in', [ChatController::class, 'setAsViewed']);
Route::get('/chat/idx/in/{id}', [ChatController::class, 'getNotificationsNewMessages'])->middleware('notification');




