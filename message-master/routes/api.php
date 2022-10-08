<?php

use App\Http\Controllers\Api\ChatsController;
use App\Http\Controllers\Api\MessagesController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::name('Api')->group(function (){
    Route::apiResource('users', UsersController::class);
    Route::apiResource('chats', ChatsController::class);
    Route::apiResource('messages', MessagesController::class);
});
