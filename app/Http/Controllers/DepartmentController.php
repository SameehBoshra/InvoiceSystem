<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request\DepartmentValidationRequest;
use App\Models\Department;
use App\repositories\departmentRepository\departmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $departmentRepository;
    public function __construct(departmentRepository $departmentRepository)
    {
        return $this->departmentRepository=$departmentRepository;
    }
    public function index()
    {
        $departments=$this->departmentRepository->getAllDepartments();
        return view('departments.index' ,compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
         $validatedData = $request->validate([
            'department_name' => 'required|string|min:5|max:255|unique:departments,department_name',
            'description' => 'required|string|min:5|max:255',]
            ,
            [
                'department_name.required' => 'اسم القسم مطلوب',
                'department_name.min' => 'اسم القسم يجب ان يكون 5 احرف على الاقل',
                'department_name.max' => 'اسم القسم يجب ان لا يتجاوز 255 حرف',
                'department_name.unique' => 'اسم القسم موجود مسبقا',
                'description.required' => 'وصف القسم مطلوب',
                'description.min' => 'وصف القسم يجب ان يكون 5 احرف على الاقل',
                'description.max' => 'وصف القسم يجب ان لا يتجاوز 255 حرف',

        ]);

        $validatedData['created_by'] = Auth::user()->name;

        $department = $this->departmentRepository->createDepartment($validatedData);

        if ($department) {
            session()->flash('Add','تم اضافة القسم بنجاح');
            return redirect()->route('departments.index');
        }

        else
        {
            session()->flash('Error','حدث خطآ ما ');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $department=Department::find($request->id);
        if (!$department) {
            session()->flash('Error', 'هذا القسم غير موجود');
            return redirect()->back();
        }
        // Validate the request data
        $validatedData = $request->validate([
            'department_name' => 'required|string|min:5|max:255|unique:departments,department_name,'.$department->id,
            'description' => 'required|string|min:5|max:255',]
            ,
            [
                'department_name.required' => 'اسم القسم مطلوب',
                'department_name.min' => 'اسم القسم يجب ان يكون 5 احرف على الاقل',
                'department_name.max' => 'اسم القسم يجب ان لا يتجاوز 255 حرف',
                'department_name.unique' => 'اسم القسم موجود مسبقا',
                'description.required' => 'وصف القسم مطلوب',
                'description.min' => 'وصف القسم يجب ان يكون 5 احرف على الاقل',
                'description.max' => 'وصف القسم يجب ان لا يتجاوز 255 حرف',

        ]);

        $validatedData['created_by'] = Auth::user()->name;

        $department = $this->departmentRepository->updateDepartment($validatedData,$request->id);

        if ($department) {
            session()->flash('Add','تم تحديث القسم بنجاح');
            return redirect()->route('departments.index');
        }

        else
        {
            session()->flash('Error','حدث خطآ ما ');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $id = Department::find($id);
        if ($id) {
            $id->delete();
            session()->flash('Add', 'تم حذف القسم بنجاح');
        } else {
            session()->flash('Error', 'حدث خطآ ما ');
        }
        return redirect()->route('departments.index');
    }


}
