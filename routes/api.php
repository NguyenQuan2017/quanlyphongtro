<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\RoomController;
use \App\Http\Controllers\PeopleController;
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

Route::group([
    'middleware' => 'api',
], function () {
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('/change-pass', [AuthController::class, 'changePassWord']);
        Route::post('/check-login', [AuthController::class, 'checkLogin']);
    });

    Route::group([
        'prefix' => 'room'
    ],function () {
        Route::get('/', [RoomController::class, 'index']);
        Route::post('/create', [RoomController::class, 'store']);
        Route::get('/{room}', [RoomController::class, 'show']);
        Route::put('/update/{room}', [RoomController::class, 'update']);
        Route::delete('/delete/{room}', [RoomController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'people'
    ],function () {
        Route::get('/', [PeopleController::class, 'index']);
        Route::post('/create', [PeopleController::class, 'store']);
        Route::get('/{people}', [PeopleController::class, 'show']);
        Route::put('/update/{people}', [PeopleController::class, 'update']);
        Route::delete('/delete/{people}', [PeopleController::class, 'destroy']);
    });
});

