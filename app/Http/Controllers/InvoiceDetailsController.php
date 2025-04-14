<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceAttachments;
use App\Models\InvoiceDetails;
use Illuminate\Http\Request;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $invoice=Invoice::find($id);
        $details=InvoiceDetails::where('id_Invoice',$id)->get();
        $attachments=InvoiceAttachments::where('invoice_id',$id)->get();
        return view('invoices.invoiceDetails' ,compact('invoice','details' ,'attachments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceDetails $invoiceDetails)
    {
        //
    }
}
