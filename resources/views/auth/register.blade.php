@extends('layouts.master2')

@section('title')
تسجيل حساب جديد
@stop

@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
	<div class="row no-gutter">
		<!-- The content half -->
		<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
			<div class="login d-flex align-items-center py-2">
				<div class="container p-0">
					<div class="row">
						<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
							<div class="card-sigin">
								<div class="mb-5 d-flex">
									<a href="{{ url('/' . $page='Home') }}">
										<img src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="sign-favicon ht-40" alt="logo">
									</a>
									<h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Mora<span>So</span>ft</h1>
								</div>
								<div class="main-signup-header">
									<h2>مرحبًا بك!</h2>
									<h5 class="font-weight-semibold mb-4">إنشاء حساب جديد</h5>
									<form method="POST" action="{{ route('register') }}">
										@csrf

										<div class="form-group">
											<label for="name">الاسم الكامل</label>
											<input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
												name="name" value="{{ old('name') }}" required autofocus>

											@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>

										<div class="form-group">
											<label for="email">البريد الإلكتروني</label>
											<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
												name="email" value="{{ old('email') }}" required>

											@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>

										<div class="form-group">
											<label for="password">كلمة المرور</label>
											<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
												name="password" required>

											@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>

										<div class="form-group">
											<label for="password-confirm">تأكيد كلمة المرور</label>
											<input id="password-confirm" type="password" class="form-control"
												name="password_confirmation" required>
										</div>

										<button type="submit" class="btn btn-main-primary btn-block">
											{{ __('تسجيل') }}
										</button>
									</form>
									<div class="mt-3 text-center">
										<p>هل لديك حساب؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- End -->
			</div>
		</div><!-- End -->

		<!-- The image half -->
		<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
			<div class="row wd-100p mx-auto text-center">
				<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
					<img src="{{ URL::asset('assets/img/media/login.png') }}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto"
						alt="logo">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
