<?php

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


//header parameters to allow external server to access
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
//header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization, Accept, X-Requested-With');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//register new user
//Route::post('/create-account', [AuthenticationController::class, 'createAccount']);

Route::post('/login', [\App\Http\Controllers\API\Auth\LoginController::class, 'login']);
Route::post('/change-password', [\App\Http\Controllers\API\Auth\ChangePasswordController::class, 'changePassword']);


//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::get('/logout', [\App\Http\Controllers\API\Auth\LogoutController::class, 'logout']);
});

Route::resource('files', \App\Http\Controllers\API\Resources\FileResource::class);
