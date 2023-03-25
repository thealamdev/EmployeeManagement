<?php

use App\Http\Controllers\UserDashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
     return view('auth.login');
});

Auth::routes();

 
// Route:: get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth','multiauth'])->name('home');
 
Route::middleware(['auth'])->group(function(){
     Route::prefix('dashboard')->name('dashboard.')->group(function(){
          Route:: get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth','multiauth'])->name('home');
           
           
          Route::prefix('user-manage')->name('user-manage.')->group(function(){
               require __DIR__ .'/user-manage/user-manage.php';
          });


          Route::prefix('multi-auth')->name('multi-auth.')->group(function(){
               require __DIR__ .'/multi-auth/multi-auth.php';
          });
          


          
         
     });
});
