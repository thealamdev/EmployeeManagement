<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboard;
use App\Http\Controllers\Backend\ShiftController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\EmployeeManageController;

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

Route::middleware(['auth','MultiAuth'])->group(function () {
     Route::prefix('dashboard')->name('dashboard.')->group(function () {
          Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

          Route::controller(DepartmentController::class)->group(function () {
               Route::prefix('department')->name('department.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
               });
          });

          Route::controller(EmployeeManageController::class)->group(function () {
               Route::prefix('employee-manage')->name('employee-manage.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                    Route::get('edit/{emp_id}', 'edit')->name('edit');
                    Route::get('show/{id}', 'show')->name('show');
                    Route::put('update/{emp_id}', 'update')->name('update');
                     
               });
          });

          
          Route::controller(UserDashboardController::class)->group(function () {
               Route::prefix('multi-auth')->name('multi-auth.')->group(function () {
                    Route::get('/','index')->name('index');
                    Route::get('create','create')->name('create');
                    Route::post('store','store')->name('store');
               });
          });

           
          Route::controller(ShiftController::class)->group(function () {
               Route::prefix('shift')->name('shift.')->group(function () {
                    Route::get('/','index')->name('index');
                    Route::get('create/{id}','create')->name('create');
                    Route::post('store','store')->name('store');
               });
          });
          
     });
});
