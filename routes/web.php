<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ManageAccountController;
use \App\Http\Controllers\CateringActionController;
use \App\Http\Controllers\ManageOrderController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => 'admin',  'middleware' => ['auth:sanctum','role:Admin']], function(){
	//Manage Account
    Route::get('/account', [ ManageAccountController::class, 'index_account'])->name('admin.index.account');
    Route::get('/create/account', [ ManageAccountController::class, 'create_account'])->name('admin.create.account');
    Route::post('/create/account', [ ManageAccountController::class, 'store_account'])->name('admin.store.account');

    //Manage Order
    Route::get('/order', [ ManageAccountController::class, 'index_account'])->name('admin.index.account');
});

Route::group(['prefix' => 'admin',  'middleware' => ['auth:sanctum','role:Catering']], function(){
    Route::get('/index/menu', [ CateringActionController::class, 'index_menu'])->name('catering.index.menu');
    Route::get('/create/menu', [ CateringActionController::class, 'create_menu'])->name('catering.create.menu');
    Route::post('/create/menu', [ CateringActionController::class, 'store_menu'])->name('catering.store.menu');
});