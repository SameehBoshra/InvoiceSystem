<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/

public function __construct()
{
    // Invoices
    $this->middleware('permission:عرض الفواتير')->only('index');
    $this->middleware('permission:اضافة فاتورة')->only(['create', 'store']);
    $this->middleware('permission:تعديل فاتورة')->only(['edit', 'update']);
    $this->middleware('permission:حذف الفاتورة')->only('destroy');
    $this->middleware('permission:تصدير الفواتير')->only('export');
    $this->middleware('permission:تغير حالة الدفع')->only('status_Update');
    $this->middleware('permission:ارشفة الفاتورة')->only('invoicesArchive');
    $this->middleware('permission:طباعة الفاتورة')->only('print');

    // Attachments
    $this->middleware('permission:اضافة مرفق')->only('create');
    $this->middleware('permission:حذف المرفق')->only('destroy');
    $this->middleware('permission:تحميل مرفق')->only('Attachments');

    // Users
    $this->middleware('permission:عرض المستخدمين')->only('index');
    $this->middleware('permission:اضافة مستخدم')->only(['create', 'store']);
    $this->middleware('permission:تعديل مستخدم')->only(['edit', 'update']);
    $this->middleware('permission:حذف مستخدم')->only('destroy');

    // Roles
    $this->middleware('permission:عرض صلاحية')->only('index') ;
    $this->middleware('permission:اضافة صلاحية')->only(['create', 'store']);
    $this->middleware('permission:تعديل صلاحية')->only(['edit', 'update']);
    $this->middleware('permission:حذف صلاحية')->only('destroy');

    // Products
    $this->middleware('permission:عرض المنتجات')->only('index') ;
    $this->middleware('permission:اضافة منتج')->only(['create', 'store']);
    $this->middleware('permission:تعديل منتج')->only(['edit', 'update']);
    $this->middleware('permission:حذف منتج')->only('destroy');

    // Sections
    $this->middleware('permission:عرض الاقسام')->only('index');
    $this->middleware('permission:اضافة قسم')->only(['create', 'store']);
    $this->middleware('permission:تعديل قسم')->only(['edit', 'update']);
    $this->middleware('permission:حذف قسم')->only('destroy');

    // Notifications
    $this->middleware('permission:الاشعارات')->only('notificationsIndex');

    // Reports
    $this->middleware('permission:عرض التقارير')->only('index');
    $this->middleware('permission:تقرير الفواتير')->only('invoiceReport');
    $this->middleware('permission:تقرير العملاء')->only('clientReport');
}









/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
$roles = Role::all();
return view('roles.index',compact('roles'));
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
$permission = Permission::get();
return view('roles.create',compact('permission'));
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required|unique:roles,name',
        'permission' => 'required',
    ],
    [
        'name.required' => 'اسم الصلاحية مطلوب',
        'name.unique' => 'اسم الصلاحية موجود مسبقا',
        'permission.required' => 'الصلاحيات مطلوبة',
    ]
);

    $role = Role::create(['name' => $request->input('name')]);

    $permissionIds = $request->input('permission');
    $permissionNames = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

    $role->syncPermissions($permissionNames);
     session()->flash('add');
    return redirect()->route('roles.index');

}
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
$role = Role::find($id);
$rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
->where("role_has_permissions.role_id",$id)
->get();
return view('roles.show',compact('role','rolePermissions'));
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$role = Role::find($id);
$permission = Permission::get();
$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
->all();
return view('roles.edit',compact('role','permission','rolePermissions'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'permission' => 'required',
    ]);

    $role = Role::find($id);
    $role->name = $request->input('name');
    $role->save();

    $permissionIds = $request->input('permission');
    $permissionNames = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

    $role->syncPermissions($permissionNames);
    session()->flash('edit');
    return redirect()->route('roles.index');
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
{
$id = $request->id;
$role = Role::find($id);
if ($role)
{
$role->delete();
session()->flash('delete');
return redirect()->route('roles.index');
}
else
{
session()->flash('error');
return redirect()->route('roles.index');
}
}
}