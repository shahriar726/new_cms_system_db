<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function (){
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');


});


