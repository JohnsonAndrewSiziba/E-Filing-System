<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return view('welcome');
    return "<h1 style='text-align: center; margin-top: 100px'>There is nothing here </h1>"
        . "<p style='text-align: center;'>&copy Johnson A. Siziba, 2022</p>";
});
