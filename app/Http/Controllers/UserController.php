<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
$users = User::all();
return view('users.index',compact('users'));
}


/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
$roles = Role::pluck('name','name')->all();
return view('users.create',compact('roles'));

}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$valid= $this->validate($request, [
'name' => 'required|min:3|max:255|unique:users,name',
'email' => 'required|email|min:3|max:255|unique:users,email',
'password' => 'required|same:confirm-password|min:6|max:255',
'roles_name' => 'required'
]
,
[
    'name.required' => 'الاسم مطلوب',
    'name.unique' => 'الاسم موجود مسبقا',
    'name.min' => 'الاسم يجب ان يكون 3 احرف على الاقل',
    'name.max' => 'الاسم يجب ان يكون 255 حرف على الاكثر',
    'email.required' => 'البريد الالكتروني مطلوب',
    'email.email' => 'البريد الالكتروني غير صحيح',
    'email.min' => 'البريد الالكتروني يجب ان يكون 3 احرف على الاقل',
    'email.max' => 'البريد الالكتروني يجب ان يكون 255 حرف على الاكثر',
    'email.unique' => 'البريد الالكتروني موجود مسبقا',
    'password.required' => 'كلمة المرور مطلوبة',
    'password.same' => 'كلمة المرور غير متطابقة',
    'password.min' => 'كلمة المرور يجب ان تكون 6 احرف على الاقل',
    'password.max' => 'كلمة المرور يجب ان تكون 255 حرف على الاكثر',
    'confirm-password.required' => 'تأكيد كلمة المرور مطلوب',
    'roles_name.required' => 'الرجاء اختيار الصلاحيات',

]
);
if($valid){
$input = $request->all();
$input['password'] = Hash::make($input['password']);
$user = User::create($input);
$user->assignRole($request->input('roles_name'));

session()->flash('add');
return redirect()->route('users.index');
}
else
{
    session()->flash('error');
    return redirect()->route('users.index');
}

}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
$user = User::find($id);
return view('users.show',compact('user'));
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$user = User::find($id);
$roles = Role::pluck('name','name')->all();
$userRole = $user->roles->pluck('name','name')->all();
return view('users.edit',compact('user','roles','userRole'));
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
'name' => 'required|min:3|max:255|unique:users,name,'.$id,
'email' => 'required|min:3|max:255|email|unique:users,email,'.$id,
'password' => 'same:confirm-password|min:6|max:255',
'roles' => 'required'
]
,
[
    'name.required' => 'الاسم مطلوب',
    'name.unique' => 'الاسم موجود مسبقا',
    'name.min' => 'الاسم يجب ان يكون 3 احرف على الاقل',
    'name.max' => 'الاسم يجب ان يكون 255 حرف على الاكثر',
    'email.required' => 'البريد الالكتروني مطلوب',
    'email.email' => 'البريد الالكتروني غير صحيح',
    'email.unique' => 'البريد الالكتروني موجود مسبقا',
    'email.min' => 'البريد الالكتروني يجب ان يكون 3 احرف على الاقل',
    'email.max' => 'البريد الالكتروني يجب ان يكون 255 حرف على الاكثر',
    'password.required' => 'كلمة المرور مطلوبة',
    'password.min' => 'كلمة المرور يجب ان تكون 6 احرف على الاقل',
    'password.max' => 'كلمة المرور يجب ان تكون 255 حرف على الاكثر',
    'password.same' => 'كلمة المرور غير متطابقة',
    'confirm-password.required' => 'تأكيد كلمة المرور مطلوب',
    'roles.required' => 'الرجاء اختيار الصلاحيات',
    'roles.array' => 'الرجاء اختيار الصلاحيات',
    'roles.min' => 'الرجاء اختيار الصلاحيات',


]

);
$input = $request->all();
if(!empty($input['password'])){
$input['password'] = Hash::make($input['password']);
}else{
$input = array_except($input,array('password'));
}
$user = User::find($id);
$user->update($input);
DB::table('model_has_roles')->where('model_id',$id)->delete();
$user->assignRole($request->input('roles'));
session()->flash('edit');
return redirect()->route('users.index');
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
{
    $id= $request->id;
    $user = User::find($id);
    if($user)
    {
        $user->delete();
        session()->flash('delete');
        return redirect()->route('users.index');
    }
    else
    {
        session()->flash('error');
        return redirect()->route('users.index');
    }
}
}
