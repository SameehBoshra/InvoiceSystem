@extends('layouts.master')
@section('title')
فواتير
@stop
@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<br>

@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 sm-4">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h3 class="mb-3  text-white">أجمالي الفواتير</h3>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">$ {{\App\Models\Invoice::sum('Total')}}</h4>
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas fa fa-database text-white"></i>
                                                <span class="text-white op-7">{{\App\Models\Invoice::count()}} </span>
                                            </span>
                                        		</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa fa-percent text-white"></i>
                                            @php
                                               $sumTotal = \App\Models\Invoice::sum('Total');
                                            $countRecords = \App\Models\Invoice::count();
                                            $result = $countRecords > 0 ? ($sumTotal / $countRecords) * 100 : 0;
                                            @endphp
											<span class="text-white op-7"> {{number_format($result)}}</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 sm-4">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h3 class="mb-3  text-white">الفواتير المدفوعة </h3>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white"> $ {{ \App\Models\Invoice::where('Status','مدفوعة')->sum('Total') }}</h4>
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas 	fa fa-database text-white"></i>
                                                <span class="text-white op-7">{{ \App\Models\Invoice::where('Status','مدفوعة')->count() }}</span>
                                            </span>										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa fa-percent text-white"></i>
                                            @php
                                            $sumTotal = \App\Models\Invoice::where('Status','مدفوعة')->sum('Total');
                                            $countRecords = \App\Models\Invoice::where('Status','مدفوعة')->count();
                                            $result = $countRecords > 0 ? ($sumTotal / $countRecords) * 100 : 0;
                                            @endphp
											<span class="text-white op-7">{{number_format( $result)  }}</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 sm-4">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h3 class="mb-3  text-white">الفواتير الغير مدفوعة </h3>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">$ {{ \App\Models\Invoice::where('Status','غير مدفوعة')->sum('Total') }}</h4>
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas 	fa fa-database text-white"></i>
                                                <span class="text-white op-7"> {{ \App\Models\Invoice::where('Status','غير مدفوعة')->count() }}</span>
                                            </span>
                                        	</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa fa-percent text-white"></i>
                                            @php
                                            $sumTotal = \App\Models\Invoice::where('Status','غير مدفوعة')->sum('Total');
                                            $countRecords = \App\Models\Invoice::where('Status','غير مدفوعة')->count();
                                            $result = $countRecords > 0 ? ($sumTotal / $countRecords) * 100 : 0;
                                            @endphp

											<span class="text-white op-7"> {{ number_format( $result) }}</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 sm-4">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h3 class="mb-3  text-white" >الفواتير المدفوعة جزئيا  </h3>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">$ {{ \App\Models\Invoice::where('Status','مدفوعة جزئيا')->sum('Total') }}</h4>
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas 	fa fa-database text-white"></i>
                                                <span class="text-white op-7"> {{ \App\Models\Invoice::where('Status','مدفوعة جزئيا')->count() }}</span>
                                            </span>										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas 	fa fa-percent text-white"></i>
                                            @php
                                            $sumTotal = \App\Models\Invoice::where('Status','مدفوعة جزئيا')->sum('Total');
                                            $countRecords = \App\Models\Invoice::where('Status','مدفوعة جزئيا')->count();
                                            $result = $countRecords > 0 ? ($sumTotal / $countRecords) * 100 : 0;
                                            @endphp
											<span class="text-white op-7"> {{ number_format( $result)  }}</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 sm-4">
						<div class="card overflow-hidden sales-card bg-info-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h3 class="mb-3  text-white" > عدد المستخدمين</h3>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas 	fa fa-database text-white"></i>
                                                <span class="text-white op-7"> {{ \App\Models\User::count() }}</span>
                                            </span>										</div>
										<span class="float-right my-auto mr-auto">

										</span>
									</div>
								</div>
							</div>
							<span id="compositeline5" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
                    @can('المستخدمين')
                    <div class="col-xl-12 col-sm-12 col-md-6">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">المستخدمين</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0"> أسم المستخدم </th>
                                                <th class="border-bottom-0"> الحالة</th>
                                                <th class="border-bottom-0"> الصلاحية</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $users=\App\Models\User::get();
                                            @endphp
                                                    @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>
                                                            @if ($user->Status == 'مفعل')
                                                            <span class="label text-success d-flex">
                                                                <div class="dot-label bg-success ml-1"></div>{{ $user->Status }}
                                                            </span>
                                                        @else
                                                            <span class="label text-danger d-flex">
                                                                <div class="dot-label bg-danger ml-1"></div>{{ $user->Status }}
                                                            </span>
                                                        @endif
                                                        </td>

                                                        <td>
                                                            @if(!empty($user->getRoleNames()))
                                                                @foreach($user->getRoleNames() as $role)
                                                                    <span class="badge bg-success">{{ $role }}</span>
                                                                @endforeach
                                                            @else
                                                                <span class="text-muted">لا يوجد صلاحيات</span>
                                                            @endif
                                                        </td>
                                                </tr>

                                                  @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
					<div class="col-xl-12 col-sm-12 col-md-6">
						<div class="card card-dashboard-map-one">
						 <div class="col-md-12">
                                <h2 style="justify-content: center">فواتير</h2>

                                    <div class="card-body">

                                        <div>
                                            <div class="mb-2">
                                                <span>
                                                    <button class="btn btn-sm" style="background-color: #8500ff" ></button>
                                                       مدفوعة
                                                </span>
                                                 <span>
                                                    <button class="btn btn-sm"  style="background-color: #285cf7" ></button>
                                                   غير مدفوعة
                                                 </span>
                                                 <span>
                                                    <button class="btn btn-sm"  style="background-color: #3bb001"></button>
                                                    مدفوعة جزئيا

                                                 </span>

                                            </div>
                                        </div>

                                        <div class="d-flex" style=""  >

                                            @php
                                                $countPaid= \App\Models\Invoice::where('Status','مدفوعة')->count();
                                                $countUnpaid= \App\Models\Invoice::where('Status','غير مدفوعة')->count();
                                                $countPartial= \App\Models\Invoice::where('Status','مدفوعة جزئيا')->count();
                                                @endphp
                                                <span style="width: 75%" id="sparkline9">{{$countPaid}},{{$countUnpaid}},{{$countPartial}}</span>
                                        </div>
                                    </div>
                                </div>
                            <!-- /div -->
                            </div><!-- col-6 -->
						</div>
					</div>
				</div>
				<!-- row closed -->



				<!-- row opened -->

				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
<!-- Internal Jquery-sparkline js -->
<script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.sparkline.js')}}"></script>
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection