<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesCustomersController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('reports.invoicesCustomers' ,compact('departments'));
    }
    public function Search_customers(Request $request){


        // في حالة البحث بدون التاريخ

             if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {


              $invoices = Invoice::select('*')->where('department_id','=',$request->department)->where('product','=',$request->product)->get();
              $departments = Department::all();
               return view('reports.customers_report',compact('departments' ,'invoices'));


             }


          // في حالة البحث بتاريخ

             else {

               $start_at = date($request->start_at);
               $end_at = date($request->end_at);


              $invoices = Invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('department_id','=',$request->Department)->where('product','=',$request->product)->get();
               $departments = Department::all();
               return view('reports.invoicesCustomers',compact('departments' ,'invoices') );


             }



            }
}
