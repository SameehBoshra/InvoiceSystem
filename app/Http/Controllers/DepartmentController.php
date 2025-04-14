<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request\DepartmentValidationRequest;
use App\Models\Department;
use App\Models\Product;
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
         $this->departmentRepository=$departmentRepository;
    }
    public function index()
    {
        $departments=$this->departmentRepository->getAllDepartments();
        return view('departments.index' ,compact('departments'));
    }


    public function store(Request $request)
    {
        // Validate the request data
         $validatedData = $request->validate([
            'department_name' => 'required|string|min:5|max:255|unique:departments,department_name',
            'description' => 'nullable|string|min:5|max:255',]
            ,
            [
                'department_name.required' => 'اسم القسم مطلوب',
                'department_name.min' => 'اسم القسم يجب ان يكون 5 احرف على الاقل',
                'department_name.max' => 'اسم القسم يجب ان لا يتجاوز 255 حرف',
                'department_name.unique' => 'اسم القسم موجود مسبقا',
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
            'description' => 'nullable|string|min:5|max:255',]
            ,
            [
                'department_name.required' => 'اسم القسم مطلوب',
                'department_name.min' => 'اسم القسم يجب ان يكون 5 احرف على الاقل',
                'department_name.max' => 'اسم القسم يجب ان لا يتجاوز 255 حرف',
                'department_name.unique' => 'اسم القسم موجود مسبقا',
                'description.min' => 'وصف القسم يجب ان يكون 5 احرف على الاقل',
                'description.max' => 'وصف القسم يجب ان لا يتجاوز 255 حرف',

        ]);

        $validatedData['created_by'] = Auth::user()->name;

        $department = $this->departmentRepository->updateDepartment($validatedData,$request->id);

        if ($department) {
            session()->flash('Update','تم تحديث القسم بنجاح');
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
            session()->flash('Delete', 'تم حذف القسم بنجاح');
        } else {
            session()->flash('Error', 'حدث خطآ ما ');
        }
        return redirect()->route('departments.index');
    }

    public function getProducts($id)
    {
        $products = Product::where('department_id', $id)->pluck('product_name', 'id');
        return response()->json($products);
    }


}
