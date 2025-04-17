<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoicesCustomersController;
use App\Http\Controllers\InvoicesReportsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::resource('invoices', InvoiceController::class)->middleware('auth')->middleware('permission:الفواتير');
Route::resource('departments', DepartmentController::class)->middleware('auth')->middleware('permission:عرض الاقسام');
Route::get('/department/{id}', [InvoiceController::class , 'getProducts'])->name('department.products')->middleware('permission:عرض الاقسام');
Route::resource('products', ProductController::class)->middleware('auth')->middleware('permission:عرض المنتجات');
Route::resource('attachments', InvoiceAttachmentsController::class)->middleware('auth')->middleware('permission:اضافة مرفق');
Route::get('InvoiceDetails/{id}', [InvoiceDetailsController::class,'index'])->middleware('auth')->middleware('permission:عرض الفواتير');
Route::get('status_show/{id}', [InvoiceController::class,'status_show'])->middleware('auth')->name('Status_show')->middleware('permission:تغير حالة الدفع');
Route::post('status_Update/{id}', [InvoiceController::class,'status_Update'])->middleware('auth')->name('status_Update')->middleware('permission:تغير حالة الدفع');
Route::get('invoicesPaid', [InvoiceController::class,'invoicesPaid'])->middleware('auth')->name('invoicesPaid')->middleware('permission:الفواتير المدفوعة');
Route::get('invoicesUnPaid', [InvoiceController::class,'invoicesUnPaid'])->middleware('auth')->name('invoicesUnPaid')->middleware('permission:الفواتير الغير مدفوعة');
Route::get('invoicesPartial', [InvoiceController::class,'invoicesPartial'])->middleware('auth')->name('invoicesPartial')->middleware('permission:الفواتير المدفوعة جزئيا');
Route::get('invoicesDeleted', [InvoiceController::class,'invoicesDeleted'])->middleware('auth')->name('invoicesDeleted')->middleware('permission:ارشيف الفواتير');
Route::delete('invoicesArchive', [InvoiceController::class,'invoicesArchive'])->middleware('auth')->name('InvoiceArchive')->middleware('permission:ارشفة الفاتورة');
Route::post('restorArchive', [InvoiceController::class,'restorArchive'])->middleware('auth')->name('restorArchive')->middleware('permission:ارشفة الفاتورة');
Route::get('Print_invoice/{id}' ,[InvoiceController::class ,'print'])->name('print.invocice')->middleware('auth')->middleware('permission:طباعة الفاتورة');

Route::resource('users', UserController::class)->middleware('auth')->middleware('permission:عرض المستخدمين');
Route::resource('roles', RoleController::class)->middleware('auth')->middleware('permission:عرض صلاحية');

Route::get('export_invoices' ,[InvoiceController::class , 'export'])->name('exportInvoices')->middleware('auth')->middleware('permission:تصدير الفواتير');

Route::get('invoices_reports' , [InvoicesReportsController::class , 'index'])->middleware('auth')->middleware('permission:التقارير');
Route::post('Search_invoices' , [InvoicesReportsController::class , 'Search_invoices'])->middleware('auth')->middleware('permission:تقرير الفواتير');

Route::get('invoices_customers' , [InvoicesCustomersController::class , 'index'])->middleware('auth')->middleware('permission:تقرير العملاء');
Route::post('Search_customers' , [InvoicesCustomersController::class , 'Search_customers'])->middleware('auth')->middleware('permission:تقرير العملاء');

Route::get('MarkAsRead_all' , [InvoiceController::class , 'MarkAsRead_all'])->name('MarkAsRead_all')->middleware('auth');





Route::get('/{page}', [AdminController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


