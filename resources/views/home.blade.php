@extends('layouts.master')
@section('title')
فواتير
@stop
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<br>
				<!-- breadcrumb -->
			{{-- 	<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
						  <p class="mg-b-0">Sales monitoring dashboard template.</p>
						</div>
					</div>
					<div class="main-dashboard-header-right">
						<div>
							<label class="tx-13">Customer Ratings</label>
							<div class="main-star">
								<i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
							</div>
						</div>
						<div>
							<label class="tx-13">Online Sales</label>
							<h5>563,275</h5>
						</div>
						<div>
							<label class="tx-13">Offline Sales</label>
							<h5>783,675</h5>
						</div>
					</div>
				</div> --}}
				<!-- /breadcrumb -->
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
			{{-- 		<div class="col-md-12 col-lg-12 col-xl-7">
						<div class="card">
							<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-0">Order status</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to arrival. To begin, enter your order number.</p>
							</div>
							<div class="card-body">
								<div class="total-revenue">
									<div>
									  <h4>120,750</h4>
									  <label><span class="bg-primary"></span>success</label>
									</div>
									<div>
									  <h4>56,108</h4>
									  <label><span class="bg-danger"></span>Pending</label>
									</div>
									<div>
									  <h4>32,895</h4>
									  <label><span class="bg-warning"></span>Failed</label>
									</div>
								  </div>
								<div id="bar" class="sales-bar mt-4"></div>
							</div>
						</div>
					</div> --}}
					<div class="col-lg-12 col-xl-5">
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

                                        <div class="d-flex" style="width: 75%"  >

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
@endsection