<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
});


Route::get('/users/{user_name?}', [UserController::class, 'getUsers'])->name('users');
Route::post('/users/update/{id}', [UserController::class, 'update']);
Route::post('/users/create', [UserController::class, 'register']);
Route::get('/users/delete/{id}', [UserController::class, 'delete']);

Route::get('/sessions/{user_name?}/{session_status?}', [UserController::class, 'getSessions'])->name('sessions');

Route::get('/login', [AuthController::class, 'index'] )->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/sendEmail', [MailController::class, 'sendMail'])->name('sendMail');