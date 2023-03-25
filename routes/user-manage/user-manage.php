<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserManageController;

Route::controller(UserManageController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('create','create')->name('create');
    Route::post('store','store')->name('store');
    
});