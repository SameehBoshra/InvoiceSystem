<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\ProductController;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
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
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

Route::resource('invoices', InvoiceController::class)->middleware('auth');
Route::resource('departments', DepartmentController::class)->middleware('auth');
Route::get('/department/{id}', InvoiceController::class . '@getProducts')->name('department.products');
Route::resource('products', ProductController::class)->middleware('auth');
Route::resource('attachments', InvoiceAttachmentsController::class)->middleware('auth');
Route::get('InvoiceDetails/{id}', [InvoiceDetailsController::class,'index'])->middleware('auth');
Route::get('status_show/{id}', [InvoiceController::class,'status_show'])->middleware('auth')->name('Status_show');
Route::post('status_Update/{id}', [InvoiceController::class,'status_Update'])->middleware('auth')->name('status_Update');


Route::get('/{page}', [AdminController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


