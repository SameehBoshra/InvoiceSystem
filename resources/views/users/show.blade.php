@extends('layouts.master')

@section('css')
<!-- Internal Font Awesome -->
<link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<!-- Internal Treeview -->
<link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
عرض المستخدم
@stop

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                <a class=" btn btn-outline-primary btn-block"
                 href="{{ route('users.index') }}"
                 >  رجوع </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
    
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>الاسم:</strong>
                        <p class="text-muted">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>البريد الإلكتروني:</strong>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>الأدوار:</strong>
                        <div>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <span class="badge badge-success">{{ $v }}</span>
                                @endforeach
                            @else
                                <p class="text-muted">لا توجد أدوار</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection