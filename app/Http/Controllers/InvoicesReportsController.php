<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesReportsController extends Controller
{
    public function index(){

        return view('reports.invoicesReports');

       }

       public function Search_invoices(Request $request){


       $rdio = $request->rdio;


    // في حالة البحث بنوع الفاتورة

       if ($rdio == 1) {


    // في حالة عدم تحديد تاريخ
           if ($request->type && $request->start_at =='' && $request->end_at =='') {

              $invoices = Invoice::all()->where('Status','=',$request->type);
              $type = $request->type;
              return view('reports.invoicesReports',compact('type' ,'invoices'));
           }

           // في حالة تحديد تاريخ استحقاق
           else {

             $start_at = date($request->start_at);
             $end_at = date($request->end_at);
             $type = $request->type;

             $invoices = Invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
             return view('reports.invoicesReports',compact('type','start_at','end_at' ,'invoices'));

           }



       }

   //====================================================================

   // في البحث برقم الفاتورة
       else {

           $invoices = Invoice::select('*')->where('invoice_number','=',$request->invoice_number)->get();
           return view('reports.invoicesReports',compact('invoices'));

       }



    }
}
