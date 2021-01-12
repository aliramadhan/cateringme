<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminActionController;
use \App\Http\Controllers\CateringActionController;
use \App\Http\Controllers\EmployeeActionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    if (auth()->user()->role == 'Employee') {
        return redirect()->route('employee.dashboard');
    }
    elseif (auth()->user()->role == 'Catering') {
        return redirect()->route('catering.dashboard');
    }
    return redirect()->route('admin.dashboard');
})->name('dashboard');
//Role Admin
Route::group(['prefix' => 'admin',  'middleware' => ['auth:sanctum','role:Admin']], function(){
    Route::get('/dashboard', [ AdminActionController::class, 'dashboard'])->name('admin.dashboard');

	//Manage Account
    Route::get('/account', [ AdminActionController::class, 'index_account'])->name('admin.index.account');
    Route::get('/create/account', [ AdminActionController::class, 'create_account'])->name('admin.create.account');
    Route::post('/create/account', [ AdminActionController::class, 'store_account'])->name('admin.store.account');

    //Manage Menu
    Route::get('/menu', [ AdminActionController::class, 'index_menu'])->name('admin.index.menu');
    Route::post('/menu', [ AdminActionController::class, 'scheduled_menu'])->name('admin.scheduled.menu');

    //Manage Schedule
    Route::get('/schedule', [ AdminActionController::class, 'index_schedule'])->name('admin.index.schedule');
    Route::post('/schedule', [ AdminActionController::class, 'store_schedule'])->name('admin.store.schedule');
    Route::post('/get-month-schedule', [ AdminActionController::class, 'get_month_schedule'])->name('admin.get_month_schedule');
});
//Role Catering
Route::group(['prefix' => 'catering',  'middleware' => ['auth:sanctum','role:Catering']], function(){
    Route::get('/dashboard', [ CateringActionController::class, 'dashboard'])->name('catering.dashboard');
    Route::get('/index/menu', [ CateringActionController::class, 'index_menu'])->name('catering.index.menu');
    Route::get('/create/menu', [ CateringActionController::class, 'create_menu'])->name('catering.create.menu');
    Route::post('/create/menu', [ CateringActionController::class, 'store_menu'])->name('catering.store.menu');
});
//Role Employee
Route::group(['prefix' => 'employee',  'middleware' => ['auth:sanctum','role:Employee']], function(){
    Route::get('/dashboard', [ EmployeeActionController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/create/order', [ EmployeeActionController::class, 'choose_order'])->name('employee.choose.order');
    Route::get('/create/order/{month}', [ EmployeeActionController::class, 'create_order'])->name('employee.create.order');
    Route::post('/create/order/', [ EmployeeActionController::class, 'store_order'])->name('employee.store.order');
    Route::post('/review/{code}/', [ EmployeeActionController::class, 'store_review'])->name('employee.store.review');

    //Get date
    Route::post('/get_date', [ EmployeeActionController::class, 'get_date'])->name('employee.get_date');
});