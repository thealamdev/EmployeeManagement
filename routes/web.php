<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeManageController;
use App\Http\Controllers\Admin\AttandanceBySuperAdminController;
use App\Http\Controllers\Employee\EmployeeAttandanceController;
use App\Http\Controllers\Employee\UserDashboardController;

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




Route::middleware(['auth', 'isAdmin'])->group(function () {
     Route::prefix('admin')->name('admin.')->group(function () {
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

          Route::controller(ShiftController::class)->group(function () {
               Route::prefix('shift')->name('shift.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create/{id}', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
               });
          });

          Route::controller(AttandanceBySuperAdminController::class)->group(function () {
               Route::prefix('attandance-control')->name('attandance-control.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                    Route::post('date-filter', 'dateFilter')->name('dateFilter');
                    Route::get('attandance', 'attandance')->name('attandance');
               });
          });
     });
});


Route::middleware(['auth', 'isEmployee'])->group(function () {
     Route::prefix('employee')->name('employee.')->group(function () {

          Route::controller(UserDashboardController::class)->group(function () {
               Route::prefix('dashboard')->name('dashboard.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
               });
          });

          // employee routes:
          Route::controller(EmployeeAttandanceController::class)->group(function () {
               Route::prefix('attandance')->name('attandance.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                    Route::get('progress', 'progress')->name('progress');
               });
          });
     });
});
