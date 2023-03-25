<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserDashboardController;

Route::controller(UserDashboardController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('create','create')->name('create');
    Route::post('store','store')->name('store');
    
});