<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (Auth::check())
    return view('home');
    else
        return view('auth.login');
});


Route::group(['middleware'=> 'auth'],function(){
    Route::resource('/client', 'App\Http\Controllers\ClientController');
    Route::resource('/pack', 'App\Http\Controllers\PackController');
    Route::post('/recherch', [App\Http\Controllers\PackController::class, 'recherch'])->name('recherch');
    Route::get('/user', [App\Http\Controllers\PackController::class, 'userindex'])->name('user');
    Route::get('/userajouter', [App\Http\Controllers\PackController::class, 'userajouter'])->name('userajouter');
    Route::post('/userstore', [App\Http\Controllers\PackController::class, 'userstore'])->name('userstore');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/useridex', [App\Http\Controllers\HomeController::class, 'useridex'])->name('useridex');
