<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


Route::group(['middleware'=> 'auth'],function(){
    Route::resource('/client', 'App\Http\Controllers\ClientController');
    Route::resource('/pack', 'App\Http\Controllers\PackController');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
