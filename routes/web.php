<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminLoginController;

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


// DON'T Put it inside the '/admin' Prefix , Otherwise you'll never get the page due to assign.guard that will redirect you too many times
Route::get('login', [AdminLoginController::class, 'showLoginForm']);
Route::post('login', [AdminLoginController::class, 'login'])->name('login');
Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']],function(){

Route::get('dashboard', [DashboardController::class, 'index'])->middleware('can:admin');

Route::resource('invoices', InvoiceController::class);

Route::get('items/{exchange_store_id}/{item_id}/{unit_id}/{qty}', [ItemController::class, 'show']);

Route::get('save_client/{name}', [ClientController::class, 'create']);

Route::post('discount', [InvoiceController::class, 'discount'])->name('invoice.discount');

});