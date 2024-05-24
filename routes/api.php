<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WindowSizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationController;

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
Route::post('/sendEmail', [MailController::class, 'sendMail']);
Route::post('/users', [UserController::class, 'checkUser']);
Route::post('/users/changeStatus', [UserController::class, 'activateOrDeactivate']);
Route::post('/inbox/changeStatus', [NotificationController::class, 'activateOrDeactivate']);
Route::post('/inbox/restaure', [NotificationController::class, 'restaure']);
Route::post('/inbox/recycle', [NotificationController::class, 'recycle']);



