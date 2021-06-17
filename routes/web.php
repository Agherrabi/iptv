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
    Route::resource('/fournisseur', 'App\Http\Controllers\FournisseurController');
    Route::resource('/panel', 'App\Http\Controllers\PanelController');
    Route::post('/getpanel', [App\Http\Controllers\PanelController::class, 'getpanel'])->name('getpanel');
    Route::post('/recherch', [App\Http\Controllers\PackController::class, 'recherch'])->name('recherch');
    Route::get('/reste15j', [App\Http\Controllers\PackController::class, 'reste15j'])->name('reste15j');
    Route::get('/clientexport', [App\Http\Controllers\PackController::class, 'clientexport'])->name('clientexport');
    Route::get('/user', [App\Http\Controllers\PackController::class, 'userindex'])->name('user')->middleware('is_admin');
    Route::get('/userajouter', [App\Http\Controllers\PackController::class, 'userajouter'])->name('userajouter')->middleware('is_admin');
    Route::post('/userstore', [App\Http\Controllers\PackController::class, 'userstore'])->name('userstore')->middleware('is_admin');
    Route::get('/useredit/{id}', [App\Http\Controllers\PackController::class, 'useredit'])->name('useredit')->middleware('is_admin');
    Route::put('/userupdate/{id}', [App\Http\Controllers\PackController::class, 'userupdate'])->name('userupdate')->middleware('is_admin');
    Route::DELETE('/userdelete/{id}', [App\Http\Controllers\PackController::class, 'userdelete'])->name('userdelete')->middleware('is_admin');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/useridex', [App\Http\Controllers\HomeController::class, 'useridex'])->name('useridex');
