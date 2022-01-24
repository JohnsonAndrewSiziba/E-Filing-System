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
    Route::resource('files', \App\Http\Controllers\API\Resources\FileResource::class);
    Route::resource('users', \App\Http\Controllers\API\Resources\UsersResource::class);


    Route::post('/files_share', [\App\Http\Controllers\API\ShareFile::class, 'index']);

});


