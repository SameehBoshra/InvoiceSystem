@extends('layouts.master')
@section('title')
قائمةالفواتير المدفوعة
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">  الفواتير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">قائمةالفواتير المدفوعة</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

@extends('alerts.notifyInvoice')
				<!-- row -->



                <div class="row">


	<!-- row opened -->

	<div class="col-xl-12">

        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">قائمة الفواتير المدفوعة</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                @can('اضافةفاتورة')
                <div>
                    <a href="invoices/create" class="btn btn-primary">
                        <i class="fas fa-plus"></i> فاتورة جديدة
                    </a>

                </div>
                @endcan
                <hr>
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ القاتورة</th>
                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                    <th class="border-bottom-0">المنتج</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0">الخصم</th>
                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                    <th class="border-bottom-0">الاجمالي</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                           @foreach($invoices as $invoice)
                            @php
                                $i++;
                            @endphp
                           <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $invoice->invoice_number }} </td>
                            <td>{{ $invoice->invoice_Date }}</td>
                            <td>{{ $invoice->Due_date }}</td>
                            <td>{{ $invoice->product }}</td>
                            <td> <a  href="{{ url('InvoiceDetails') }}/{{ $invoice->id }}">{{$invoice->department->department_name}} </a></td>
                            <td>{{ $invoice->Discount }}</td>
                            <td>{{ $invoice->Rate_VAT }}</td>
                            <td>{{ $invoice->Value_VAT }}</td>
                            <td>{{ $invoice->Total }}</td>
                            <td>
                                @if ($invoice->Value_Status == 1)
                                    <span class="text-success">{{ $invoice->Status }}</span>
                                @elseif($invoice->Value_Status == 2)
                                    <span class="text-danger">{{ $invoice->Status }}</span>
                                @else
                                    <span class="text-warning">{{ $invoice->Status }}</span>
                                @endif

                            </td>

                            <td>{{ $invoice->note }}</td>
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                        type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                    <div class="dropdown-menu tx-13">
                                        @can('تعديل الفاتورة')
                                            <a class="dropdown-item"
                                                href="{{ route('invoices.edit', $invoice->id )}}">
                                                <i class="text-danger fas fa-pen-alt"></i>
                                                &nbsp;&nbsp;
                                                تعديل
                                                الفاتورة</a>
                                        @endcan
                                        @can('حذف الفاتورة')
                                            <a class="dropdown-item"
                                            href="#modalDelete"
                                                data-toggle="modal"
                                                data-id={{$invoice->id}}
                                              data-invoice_number={{$invoice->invoice_number}}>
                                                <i class="text-danger fas fa-trash-alt"></i>
                                                &nbsp;&nbsp;حذف
                                                الفاتورة</a>
                                        @endcan

                                        @can('تغير حالة الدفع')
                                            <a class="dropdown-item"
                                                href="{{ URL::route('Status_show', $invoice->id) }}"><i
                                                    class=" text-success fas                                                                                                                                                                                                                                                                                                                                                                                                                                                      fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                حالة
                                                الدفع</a>
                                        @endcan
                                        @can('ارشفة الفاتورة')

                                            <a class="dropdown-item"
                                             href="#modalDeleteArchive"
                                             data-id="{{ $invoice->id }}"
                                                data-invoice_number="{{ $invoice->invoice_number }}"
                                                data-toggle="modal"><i
                                                    class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                الارشيف</a>
                                        @endcan

                                        @can('طباعة الفاتورة')
                                            <a class="dropdown-item" href="Print_invoice/{{ $invoice->id }}"><i
                                                    class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                الفاتورة
                                            </a>
                                        @endcan
                                    </div>
                                </div>

                            </td>
                        </tr>
                           @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
      <!-- modal delete -->
      <div class="modal" id="modalDelete">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف الفاتورة</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="invoices/destory" method="POST">
                   @csrf
                   @method('DELETE')

                    <div class="modal-body">
                        <p>هل انت متأكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="invoice_number" id="invoice_number" type="text" readonly>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal delete -->

        <!-- modal delete from archive -->
        <div class="modal" id="modalDeleteArchive">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">نقل الفاتورة إلي اﻷرشيف</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="invoices/destory" method="POST">
                       @csrf
                       @method('DELETE')

                        <div class="modal-body">
                            <p>هل انت متأكد من عملية اﻷرشفة ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="invoice_number" id="invoice_number" type="text" readonly>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-danger">تأكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal delete from archive -->
    <!-- /row -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
     $('#modalDelete').on('show.bs.modal' ,function(event)
{
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    var invoice_number = button.data('invoice_number')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #invoice_number').val(invoice_number);
})

$('#modalDeleteArchive').on('show.bs.modal' ,function(event)
{
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    var invoice_number = button.data('invoice_number')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #invoice_number').val(invoice_number);
})
</script>
@endsection