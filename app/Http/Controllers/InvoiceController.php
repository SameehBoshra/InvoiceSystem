<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\Department;
use App\Models\Invoice;
use App\Models\InvoiceAttachments;
use App\Models\InvoiceDetails;
use App\Models\Product;
use App\Models\User;
use App\Notifications\AddInvoice;
use App\Notifications\AddInvoiceNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index' ,compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('invoices.create' ,compact('departments'));
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'invoice_number'     => 'required|string|max:50|unique:invoices,invoice_number',
            'invoice_Date'       => 'required|date',
            'Due_date'           => 'required|date|after_or_equal:invoice_Date',
            'product'            => 'required|string|max:100',
            'department'         => 'required|exists:departments,id',
            'Amount_collection'  => 'required|numeric|min:0',
            'Amount_Commission'  => 'required|numeric|min:0',
            'Discount'           => 'required|numeric|min:0',
            'Value_VAT'          => 'required|numeric|min:0',
            'Rate_VAT'           => 'required',
            'Total'              => 'required|numeric|min:0',
            'note'               => 'nullable|string|max:1000',
            'pic'                => 'nullable|mimes:pdf,jpeg,jpg,png,webp|max:2048', // max 2MB
        ]
    ,
[
            'invoice_number.unique' => 'رقم الفاتورة موجود مسبقاً',
            'invoice_number.required' => 'رقم الفاتورة مطلوب',
            'invoice_Date.required' => 'تاريخ الفاتورة مطلوب',
            'Due_date.required'     => 'تاريخ الاستحقاق مطلوب',
            'product.required'      => 'اسم المنتج مطلوب',
            'department.required'   => 'اسم القسم مطلوب',
            'Amount_collection.required' => 'المبلغ المطلوب جمعه مطلوب',
            'Amount_collection.numeric' => 'المبلغ المطلوب جمعه يجب أن يكون رقم',
            'Amount_Commission.required' => 'المبلغ المطلوب كعمولة مطلوب',
            'Amount_Commission.numeric' => 'المبلغ المطلوب كعمولة يجب أن يكون رقم',
            'Discount.required'     => 'الخصم مطلوب',
            'Value_VAT.required'    => 'قيمة ضريبة القيمة المضافة مطلوبة',
            'Value_VAT.numeric'     => 'قيمة ضريبة القيمة المضافة يجب أن تكون رقم',
            'Rate_VAT.required'     => 'نسبة ضريبة القيمة المضافة مطلوبة',
            'Total.required'        => 'المجموع الكلي مطلوب',
]);

        $invoice = Invoice::create([
            'invoice_number'     => $request->invoice_number,
            'invoice_Date'       => $request->invoice_Date,
            'Due_date'           => $request->Due_date,
            'product'            => $request->product,
            'department_id'      => $request->department,
            'Amount_collection'  => $request->Amount_collection,
            'Amount_Commission'  => $request->Amount_Commission,
            'Discount'           => $request->Discount,
            'Value_VAT'          => $request->Value_VAT,
            'Rate_VAT'           => $request->Rate_VAT,
            'Total'              => $request->Total,
            'Status'             => 'غير مدفوعة',
            'Value_Status'       => 2,
            'note'               => $request->note,
        ]);

        InvoiceDetails::create([
            'id_Invoice'      => $invoice->id,
            'invoice_number'  => $request->invoice_number,
            'product'         => $request->product,
            'department'      => $request->department,
            'Status'          => 'غير مدفوعة',
            'Value_Status'    => 2,
            'note'            => $request->note,
            'user'            => Auth::user()->name,
        ]);

        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();

            $attachments = new InvoiceAttachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $request->invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice->id;
            $attachments->save();

            // نقل الملف
            $request->pic->move(public_path('Attachments/' . $request->invoice_number), $file_name);
        }
// notify by email
        $user=User::first();
        Notification::send($user ,new AddInvoice($invoice->id));
// notify by database when user add to admin
        $userAdd=User::get();
        // هات اخر id اضاف
        $invoiceNewId=Invoice::latest()->first();

        Notification::send($userAdd ,new AddInvoiceNotification($invoiceNewId));


        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return redirect()->route('invoices.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $departments = Department::all();
        $invoice = Invoice::findOrFail($id);
        $attachments = InvoiceAttachments::where('invoice_id', $invoice->id)->get();
        return view('invoices.edit' , compact('invoice', 'departments', 'attachments'));
    }

    /**
     * Update the specified resource in storage.
     */

        public function update(Request $request, $id)
        {
            $invoice = Invoice::findOrFail($id);

            $validated = $request->validate([
                'invoice_number'     => 'required|string|max:50|unique:invoices,invoice_number,' . $invoice->id,
                'invoice_Date'       => 'required|date',
                'Due_date'           => 'required|date|after_or_equal:invoice_Date',
                'product'            => 'required|string|max:100',
                'department'         => 'required|exists:departments,id',
                'Amount_collection'  => 'required|numeric|min:0',
                'Amount_Commission'  => 'required|numeric|min:0',
                'Discount'           => 'required|numeric|min:0',
                'Value_VAT'          => 'required|numeric|min:0',
                'Rate_VAT'           => 'required',
                'Total'              => 'required|numeric|min:0',
                'note'               => 'nullable|string|max:1000',
                'pic'                => 'nullable|mimes:pdf,jpeg,jpg,png,webp|max:2048', // max 2MB
            ]
        ,
    [
                'invoice_number.unique' => 'رقم الفاتورة موجود مسبقاً',
                'invoice_number.required' => 'رقم الفاتورة مطلوب',
                'invoice_Date.required' => 'تاريخ الفاتورة مطلوب',
                'Due_date.required'     => 'تاريخ الاستحقاق مطلوب',
                'product.required'      => 'اسم المنتج مطلوب',
                'department.required'   => 'اسم القسم مطلوب',
                'Amount_collection.required' => 'المبلغ المطلوب جمعه مطلوب',
                'Amount_collection.numeric' => 'المبلغ المطلوب جمعه يجب أن يكون رقم',
                'Amount_Commission.required' => 'المبلغ المطلوب كعمولة مطلوب',
                'Amount_Commission.numeric' => 'المبلغ المطلوب كعمولة يجب أن يكون رقم',
                'Discount.required'     => 'الخصم مطلوب',
                'Value_VAT.required'    => 'قيمة ضريبة القيمة المضافة مطلوبة',
                'Value_VAT.numeric'     => 'قيمة ضريبة القيمة المضافة يجب أن تكون رقم',
                'Rate_VAT.required'     => 'نسبة ضريبة القيمة المضافة مطلوبة',
                'Total.required'        => 'المجموع الكلي مطلوب',
    ]);
            $invoice->update([
                'invoice_number' => $request->invoice_number,
                'invoice_Date' => $request->invoice_Date,
                'Due_date' => $request->Due_date,
                'department_id' => $request->department,
                'product' => $request->product,
                'Amount_collection' => $request->Amount_collection,
                'Amount_Commission' => $request->Amount_Commission,
                'Discount' => $request->Discount,
                'Rate_VAT' => $request->Rate_VAT,
                'Value_VAT' => $request->Value_VAT,
                'Total' => $request->Total,
                'note' => $request->note,
            ]);

        session()->flash('Update', 'تم تحديث الفاتورة بنجاح');
        return redirect()->route('invoices.index');

   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $id = Invoice::find($id);
        if ($id) {
            $id->delete();
            session()->flash('Delete');
        } else {
            session()->flash('Error');
        }
        return redirect()->route('invoices.index');
    }

    public function invoicesArchive(Request $request)
    {

        $id = $request->id;

        $id = Invoice::find($id);
        if ($id) {
            $id->delete();
            session()->flash('Archive');
        } else {
            session()->flash('Error');
        }
        return redirect()->route('invoices.index');
    }


    public function getproducts($id)
    {
        $products = DB::table("products")->where("department_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }


    public function status_show($id)
    {
        $departments = Department::all();
        $invoice = Invoice::findOrFail($id);
        return view('invoices.status_show', compact('invoice' , 'departments'));
    }

    public function status_Update($id, Request $request)
    {
        $invoices = Invoice::findOrFail($id);

        if ($request->Status === 'مدفوعة') {

            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => now(),
            ]);

            InvoiceDetails::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'department' => $request->department,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => now(),
                'user' => (Auth::user()->name),
            ]);
        }

        else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            InvoiceDetails::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'department' => $request->department,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');

    }

    public function invoicesPaid()
    {
        $invoices = Invoice::where('Value_Status', 1)->get();
        return view('invoices.invoicesPaid', compact('invoices'));
    }
    public function invoicesUnPaid()
    {
        $invoices = Invoice::where('Value_Status', 2)->get();
        return view('invoices.invoicesUnPaid', compact('invoices'));
    }
    public function invoicesPartial()
    {
        $invoices = Invoice::where('Value_Status', 3)->get();
        return view('invoices.invoicesPartial', compact('invoices'));
    }
    public function invoicesDeleted()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('invoices.invoicesDeleted', compact('invoices'));
    }
    public function restorArchive(Request $request)
    {
        $id = $request->id;
        $invoice = Invoice::withTrashed()->where('id',$id)->restore();
        session()->flash('restorArchive');
        return redirect()->route('invoices.index');
    }

    public function print($id)
    {
        $invoices=Invoice::find($id);
        return view('invoices.printInvoice' ,compact('invoices'));

    }

    public function export()
    {
        $invoices = Invoice::all();
        if(count($invoices) == 0){
            session()->flash('notExport');
            return redirect()->route('invoices.index');
        }
        else
        {
            Excel::download(new InvoicesExport, 'invoices.xlsx');

            session()->flash('export');
            return redirect()->route('invoices.index');

        }


    }

    public function MarkAsRead_all()
    {
       $userUnReadNotification=auth()->user()->unreadNotifications;

       if($userUnReadNotification)
       {
        $userUnReadNotification->markAsRead();
       }
       return redirect()->back();
    }

}
