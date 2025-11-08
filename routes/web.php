<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::redirect('/', '/admin');
Route::redirect('login', '/admin');
Route::redirect('register', '/admin');
Route::redirect('logout', '/admin');
