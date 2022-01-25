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


//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::post('/change_password', [\App\Http\Controllers\API\Auth\ChangePasswordController::class, 'changePassword']);
    Route::get('/logout', [\App\Http\Controllers\API\Auth\LogoutController::class, 'logout']);
    Route::resource('files', \App\Http\Controllers\API\Resources\FileResource::class);
    Route::resource('users', \App\Http\Controllers\API\Resources\UsersResource::class);


    Route::post('/files_share', [\App\Http\Controllers\API\ShareFile::class, 'index']);

    Route::get('/recent_files', [\App\Http\Controllers\API\RecentFiles::class, 'index']);
    Route::get('/recent_count', [\App\Http\Controllers\API\RecentFiles::class, 'count']);

    Route::get('/shared_files', [\App\Http\Controllers\API\SharedFiles::class, 'index']);
    Route::get('/shared_count', [\App\Http\Controllers\API\SharedFiles::class, 'count']);

    Route::get('/starred_files', [\App\Http\Controllers\API\StarredFiles::class, 'index']);
    Route::get('/starred_count', [\App\Http\Controllers\API\StarredFiles::class, 'count']);

    Route::get('/trashed_files', [\App\Http\Controllers\API\TrashedFiles::class, 'index']);
    Route::get('/trashed_count', [\App\Http\Controllers\API\TrashedFiles::class, 'count']);

    Route::post('/file_star', [\App\Http\Controllers\API\StarFile::class, 'index']);
    Route::post('/file_delete', [\App\Http\Controllers\API\DeleteFile::class, 'index']);



});


