<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminActionController;
use \App\Http\Controllers\CateringActionController;
use \App\Http\Controllers\EmployeeActionController;
use \App\Notifications\TeleNotif;
use Illuminate\Support\Facades\Notification;
use Telegram\Bot\Laravel\Facades\Telegram;

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
Route::get('setcookie', function(){
    Session::setId($_GET['id']);
    Session::start();
    return redirect()->route('dashboard');
});
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/cek-telegram', function () {
    $activity = Telegram::getUpdates();
    return dd($activity);
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

Route::get('/cek_pesan', [ AdminActionController::class, 'cek_pesan'])->name('admin.cek_pesan');

Route::group(['prefix' => 'admin',  'middleware' => ['auth:sanctum','role:Admin']], function(){
    //Dashboard
    Route::get('/dashboard', [ AdminActionController::class, 'dashboard'])->name('admin.dashboard');
    //Index Review
    Route::get('/review', [ AdminActionController::class, 'index_review'])->name('admin.index.review');
    //Manage Employee who can order catering
    Route::get('/can_order/{code}', [ AdminActionController::class, 'can_order'])->name('admin.can_order');

	//Manage Account
    Route::get('/account', [ AdminActionController::class, 'index_account'])->name('admin.index.account');
    Route::get('/create/account', [ AdminActionController::class, 'create_account'])->name('admin.create.account');
    Route::post('/create/account', [ AdminActionController::class, 'store_account'])->name('admin.store.account');
    Route::put('/update/account', [ AdminActionController::class, 'update_account'])->name('admin.update.account');
    Route::get('/delete/account/{email}', [ AdminActionController::class, 'delete_account'])->name('admin.delete.account');
    Route::get('/reset/password/{email}', [ AdminActionController::class, 'reset_password'])->name('admin.reset.password');

    //Manage Menu
    Route::get('/menu', [ AdminActionController::class, 'index_menu'])->name('admin.index.menu');
    Route::post('/menu', [ AdminActionController::class, 'scheduled_menu'])->name('admin.scheduled.menu');
    Route::post('/update/menu-price', [ AdminActionController::class, 'update_menu_price'])->name('admin.update.menu_price');

    //Manage Slideshow
    Route::get('/slideshow', [ AdminActionController::class, 'index_slideshow'])->name('admin.index.slideshow');
    Route::post('/slideshow', [ AdminActionController::class, 'store_slideshow'])->name('admin.store.slideshow');
    Route::get('/slideshow/{id}/destroy', [ AdminActionController::class, 'delete_slideshow'])->name('admin.delete.slideshow');

    //Manage Request
    Route::get('/request', [ AdminActionController::class, 'index_request'])->name('admin.index.request');
    Route::post('/user-deactivated-can-order-directly/{id}', [AdminActionController::class, 'deactivated_user_order'])->name('admin.deactivated.order.direct');

    //Report
    Route::get('/order', [ AdminActionController::class, 'index_order_catering'])->name('admin.index.order_catering');
    Route::get('/order/today', [ AdminActionController::class, 'index_order'])->name('admin.index.order');
    Route::get('/order/not-taken', [ AdminActionController::class, 'index_order_not_taken'])->name('admin.index.order_not_taken');
});
//Role Catering
Route::group(['prefix' => 'catering',  'middleware' => ['auth:sanctum','role:Catering']], function(){
    //Dashboard
    Route::get('/dashboard', [ CateringActionController::class, 'dashboard'])->name('catering.dashboard');

    //Manage Menu
    Route::get('/index/menu', [ CateringActionController::class, 'index_menu'])->name('catering.index.menu');
    Route::get('/create/menu', [ CateringActionController::class, 'create_menu'])->name('catering.create.menu');
    Route::post('/create/menu', [ CateringActionController::class, 'store_menu'])->name('catering.store.menu');
    Route::get('/send/message', [ CateringActionController::class, 'send_message'])->name('catering.send.message');
    Route::get('/edit/menu/{menu_code}', [ CateringActionController::class, 'edit_menu'])->name('catering.edit.menu');
    Route::put('/update/menu/{menu_code}', [ CateringActionController::class, 'update_menu'])->name('catering.update.menu');
    Route::delete('/delete/menu/{menu_code}', [ CateringActionController::class, 'delete_menu'])->name('catering.delete.menu');
    Route::get('/delete/photo/menu/{id}', [ CateringActionController::class, 'delete_photo'])->name('catering.delete.photo');

    //served menu
    Route::post('/served/menu', [ CateringActionController::class, 'served_menu'])->name('catering.served.menu');

    //Index Menu at Scheduler
    Route::get('/index/menu-schedule', [ CateringActionController::class, 'index_menu_schedule'])->name('catering.index.menu_schedule');

    //Manage Schedule
    Route::get('/schedule', [ CateringActionController::class, 'index_schedule'])->name('catering.index.schedule');
    Route::post('/schedule', [ CateringActionController::class, 'store_schedule'])->name('catering.store.schedule');
    Route::post('/get-month-schedule', [ CateringActionController::class, 'get_month_schedule'])->name('catering.get_month_schedule');

    //Report
    Route::get('/index/review', [ CateringActionController::class, 'index_review'])->name('catering.index.review');
    Route::get('/index/report', [ CateringActionController::class, 'index_report'])->name('catering.index.report');
    Route::get('/index/catering-today', [ CateringActionController::class, 'index_catering'])->name('catering.index.catering');
});
//Role Employee
Route::group(['prefix' => 'employee',  'middleware' => ['auth:sanctum','role:Employee']], function(){
    Route::get('/dashboard', [ EmployeeActionController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/create/order', [ EmployeeActionController::class, 'create_order'])->name('employee.create.order');
    Route::post('/create/order/', [ EmployeeActionController::class, 'store_order'])->name('employee.store.order');
    Route::post('/review/{code}/', [ EmployeeActionController::class, 'store_review'])->name('employee.store.review');
    Route::get('/order/{id}', [ EmployeeActionController::class, 'delete_order'])->name('employee.delete.order');
    Route::get('/history/order', [ EmployeeActionController::class, 'history_order'])->name('employee.history.order');
    Route::get('/history/review', [ EmployeeActionController::class, 'history_review'])->name('employee.history.review');

    //Manage Request
    Route::get('/request', [ EmployeeActionController::class, 'index_request'])->name('employee.index.request');
    Route::post('/request', [ EmployeeActionController::class, 'create_request'])->name('employee.create.request');

    //Get data
    Route::post('/get_photos', [ EmployeeActionController::class, 'get_photos'])->name('employee.get_photos');
    Route::get('/get-schedule',[ EmployeeActionController::class, 'get_schedule'])->name('employee.get_schedule');
});