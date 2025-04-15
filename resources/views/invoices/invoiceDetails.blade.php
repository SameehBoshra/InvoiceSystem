@extends('layouts.master')
@section('title')
    تفاصيل الفاتورة
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفاتورة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
                        @extends('alerts.notifyInvoiceDetails')

						<div class="card" id="basic-alert">
							<div class="card-body">
								<div>
									<h6 class="card-title mb-1">تفاصيل الفاتورة</h6>
								</div>
								<div class="text-wrap">
									<div class="example">
										<div class="panel panel-primary tabs-style-1">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">الفاتورة</a></li>
														<li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">تفاصيل الفاتورة</a></li>
														<li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">الملحقات</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
												<div class="tab-content">
                                                    <!-- invoice -->
													<div class="tab-pane active" id="tab1">
                                                        <div class="container mt-5">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th>رقم الفاتورة</th>
                                                                        <td>{{ $invoice->invoice_number }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>تاريخ الفاتورة</th>
                                                                        <td>{{ $invoice->invoice_Date }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>تاريخ الاستحقاق</th>
                                                                        <td>{{ $invoice->Due_date }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>القسم</th>
                                                                        <td>{{ $invoice->department->department_name ?? '---' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>المنتج</th>
                                                                        <td>{{ $invoice->product }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>مبلغ التحصيل</th>
                                                                        <td>{{ $invoice->Amount_collection }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>مبلغ العمولة</th>
                                                                        <td>{{ $invoice->Amount_Commission }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الخصم</th>
                                                                        <td>{{ $invoice->Discount }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>نسبة الضريبة</th>
                                                                        <td>{{ $invoice->Rate_VAT }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>قيمة الضريبة</th>
                                                                        <td>{{ $invoice->Value_VAT }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الإجمالي</th>
                                                                        <td>{{ $invoice->Total }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الحالة</th>
                                                                        <td>{{ $invoice->Status }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>تاريخ الدفع</th>
                                                                        <td>{{ $invoice->Payment_Date ?? 'لم يتم الدفع بعد' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>ملاحظات</th>
                                                                        <td>{{ $invoice->note ?? 'لا توجد ملاحظات' }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
													</div>
                                                    <!-- end invoices -->
                                                    <!-- invoice details -->
													<div class="tab-pane" id="tab2">

                                                        <div class="container mt-5">

                                                            @foreach ($details as $detail)
                                                                <div class="card mb-4">

                                                                    <div class="card-body">
                                                                        <table class="table table-bordered">
                                                                            <tr>
                                                                                <th>رقم الفاتورة</th>
                                                                                <td>{{ $detail->invoice_number }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>المنتج</th>
                                                                                <td>{{ $detail->product }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>القسم</th>
                                                                                <td>{{ \App\Models\Department::find($detail->department)->department_name ?? 'غير معروف' }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>الحالة</th>
                                                                                <td>
                                                                                    @if($detail->Value_Status == 1)
                                                                                        <span class="badge bg-success">{{ $detail->Status }}</span>
                                                                                    @elseif($detail->Value_Status == 2)
                                                                                        <span class="badge bg-danger">{{ $detail->Status }}</span>
                                                                                    @else
                                                                                        <span class="badge bg-warning text-dark">{{ $detail->Status }}</span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>تاريخ الدفع</th>
                                                                                <td>{{ $detail->Payment_Date ?? 'لم يتم الدفع بعد' }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>ملاحظات</th>
                                                                                <td>{{ $detail->note ?? 'لا توجد ملاحظات' }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>المستخدم</th>
                                                                                <td>{{ $detail->user }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>تاريخ الإضافة</th>
                                                                                <td>{{ $detail->created_at->format('Y-m-d') }}</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>



                                                    </div>
                                                    <!-- end invoice details -->
                                                    <!-- attachments -->
													<div class="tab-pane" id="tab3">
                                                        <div class="container mt-5">
                                                            <h4 class="mb-4"> الملحقات</h4>

                                                            @forelse ($attachments as $attachment)
                                                                <div class="table-responsive mb-4">
                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <th>رقم الفاتورة</th>
                                                                            <td>{{ $attachment->invoice_number }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>اسم الملف</th>
                                                                            <td>{{ $attachment->file_name }}</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>أضيف بواسطة</th>
                                                                            <td>{{ $attachment->Created_by }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>تاريخ الإضافة</th>
                                                                            <td>{{ \Carbon\Carbon::parse($attachment->created_at)->format('Y-m-d') }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>عرض الملف</th>
                                                                            <td>
                                                                                <a href="{{ url('Attachments/' . $attachment->invoice_number . '/' . $attachment->file_name) }}" target="_blank" class="btn btn-info btn-sm">
                                                                                    عرض
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>تحميل الملف</th>
                                                                            <td>
                                                                                <a href="{{ url('Attachments/' . $attachment->invoice_number . '/' . $attachment->file_name) }}" download class="btn btn-success btn-sm">
                                                                                    تحميل
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>حذف الملف</th>
                                                                            <td>
                                                                                <form action="{{ route('attachments.destroy', $attachment->id) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                                                                </form>
                                                                            </td>
                                                                    </table>
                                                                </div>
                                                            @empty
                                                                <div class="alert alert-warning">لا توجد مرفقات لهذه الفاتورة.</div>
                                                            @endforelse
                                                        </div>

                                                    </div>
                                                    <!-- end attachments -->
												</div>
											</div>
										</div>
									</div>

<!-- Prism Code -->

<!-- End Prism Precode -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection