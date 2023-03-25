<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ShiftController;
 

Route::controller(ShiftController::class)->middleware(['auth','multiauth','isEmployee'])->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/store','store')->name('store');
    Route::get('/edit','edit')->name('edit');
});