@extends('layouts.master')
@section('title')
الأقسام
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
							<h4 class="content-title mb-0 my-auto">اﻷعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأقسام</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


 @if (session()->has('Add'))

    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
        {{ session()->get('Add') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('Error'))
    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
        {{ session()->get('Error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">اﻷقسام</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>
                            <!-- Add department -->
                            <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                                <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-flip-horizontal" data-toggle="modal" href="#modaldemo8">أضافة قسم جديد</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0"> أسم القسم </th>
                                                <th class="border-bottom-0"> الوصف</th>
                                                <th class="border-bottom-0"> اﻷجراءات</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                                    @foreach ($departments as $department)
                                                    <tr>

                                                    <td>{{ $department->id }}</td>
                                                    <td>{{ $department->department_name }}</td>
                                                    <td>{{ $department->description }}</td>
                                                    <td>
                                                        <a class="btn btn-outline-success btn-sm
                                                        modal-effect btn btn-outline-primary"
                                                        data-effect="effect-flip-horizontal"
                                                        data-toggle="modal"
                                                        href="#modalEdit"
                                                        data-id="{{ $department->id }}"
                                                        data-department_name="{{ $department->department_name }}"
                                                        data-description="{{ $department->description }}">
                                                         <i class="las la-pen"></i>
                                                     </a>

                                                        <a class="btn btn-outline-danger btn-sm
                                                        modal-effect btn btn-outline-primary "
                                                        data-effect="effect-flip-horizontal"
                                                        data-toggle="modal"
                                                        href="#modalDelete"
                                                        data-id={{$department->id}}
                                                        data-department_name={{$department->department_name}}
                                                        >
                                                        <li class="las la-trash"></li>
                                                    </a>
                                                    {{--     <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: inline-block;" >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm">حذف</button>
                                                        </form> --}}
                                                    </td>
                                                </tr>

                                                  @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<!-- row closed -->
			</div>
            <!-- modal create -->
            <div class="modal" id="modaldemo8">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h1 class="modal-title"> أضافة قسم
                        </h1><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="" action="{{route('departments.store')}}" method="POST">
                                                  @csrf
                                                    <div class="form-group has-success mg-b-0">
                                                            <label>أسم القسم</label>
                                                            <input class="form-control" placeholder=""  type="text" value="" name='department_name'>
                                                            @error('department_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <label>الوصف </label>
                                                        <textarea class="form-control mg-t-20" placeholder=""  rows="3" name="description"></textarea>
                                                        @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-primary" type="submit">حفظ</button>
                                                        </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- End modal create -->
            <!-- moadal edit -->
            <div class="modal" id="modalEdit">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h1 class="modal-title"> تعديل القسم
                        </h1><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="" action="departments/update" method="POST">
                                                  @csrf
                                                  @method('PATCH')
                                                    <div class="form-group has-success mg-b-0">
                                                        <input hidden name="id" id="id" value="">
                                                            <label>أسم القسم</label>
                                                            <input class="form-control" id="department_name" placeholder=""  type="text" value="" name='department_name'>
                                                            @error('department_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <label>الوصف </label>
                                                        <textarea class="form-control mg-t-20" id="description" placeholder=""  rows="3" name="description"></textarea>
                                                        @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-primary" type="submit">تحديث</button>
                                                        </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- end modal edit -->

            <!-- modal delete -->
            <div class="modal" id="modalDelete">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">حذف المنتج</h6>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="departments/destory" method="POST">
                           @csrf
                           @method('DELETE')

                            <div class="modal-body">
                                <p>هل انت متأكد من عملية الحذف ؟</p><br>
                                <input type="hidden" name="id" id="id" value="">
                                <input class="form-control" name="department_name" id="department_name" type="text" readonly>
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
    $('#modalEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var department_name = button.data('department_name')
        var description = button.data('description')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other
        // library if you wanted to.
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #department_name').val(department_name);
        modal.find('.modal-body #description').val(description);
    })

    $('#modalDelete').on('show.bs.modal' ,function(event)
{
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    var department_name = button.data('department_name')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #department_name').val(department_name);
})
</script>



@endsection