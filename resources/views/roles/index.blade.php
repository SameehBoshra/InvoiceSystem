@extends('layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@stop
@section('title')
صلاحيات المستخدمين
@stop
@can('عرض صلاحية')
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                صلاحيات المستخدمين</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@extends('alerts.notifyRole')

<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">الصلاحيات </h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            @can('اضافة صلاحية')
        <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
            <a class=" btn btn-outline-primary btn-block"
             href="{{ route('roles.create') }}"
             >أضافة  صلاحية جديدة </a>
        </div>
        @endcan

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>العمليات</th>
                                </tr>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($roles as $key => $role)
                                @php
                                    $i++;
                                @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @can('عرض صلاحية')
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('roles.show', $role->id) }}">
                                            <i class="las la-eye"></i>
                                        </a>
                                    @endcan

                                    @can('تعديل صلاحية')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('roles.edit', $role->id) }}">
                                            <i class="las la-pen"></i>
                                        </a>
                                    @endcan

                                    @if ($role->name !== 'owner')
                                        @can('حذف صلاحية')
                                        <a class="btn btn-danger btn-sm
                                        modal-effect btn btn-outline-primary "
                                        data-effect="effect-flip-horizontal"
                                        data-toggle="modal"
                                        href="#modalDelete"
                                        data-id={{$role->id}}
                                        data-name={{$role->name}}
                                        >
                                        <li class="las la-trash"></li>
                                        </a>
                                        @endcan
                                    @endif


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
               <!-- modal delete -->
               <div class="modal" id="modalDelete">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">حذف الصلاحية</h6>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="roles/destory" method="POST">
                           @csrf
                           @method('DELETE')

                            <div class="modal-body">
                                <p>هل انت متأكد من عملية الحذف ؟</p><br>
                                <input type="hidden" name="id" id="id" value="">
                                <input class="form-control" name="name" id="name" type="text" readonly>

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
        </div>
    </div>
</div>
<!-- main-content closed -->
@endsection
@endcan
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script>
      $('#modalDelete').on('show.bs.modal' ,function(event)
{
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    var name = button.data('name')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
})
</script>
@endsection
