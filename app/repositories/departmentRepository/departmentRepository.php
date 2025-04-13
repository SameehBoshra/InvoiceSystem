<?php
namespace App\repositories\departmentRepository;

use App\Models\Department;
use App\repositories\departmentRepository\interfaces\iDepartmentRepository;

class departmentRepository implements iDepartmentRepository
{
    public function getAllDepartments()
    {
        return Department::all();

    }
    public function getDepartmentById($id)
    {
        $department=Department::find($id);
        if(!$department)
        {
            return view('404');
        }
        else
        return $department;
    }
    public function createDepartment(array $data)
    {
        return Department::create($data);

    }
    public function updateDepartment(array $data, $id)
    {

        $department = Department::find($id);
        if ($department) {
            $department->update($data);
            return $department;
        }
        return view('404');
    }
    public function deleteDepartment($id)
    {
        $department = Department::find($id);
        if ($department) {
            $department->delete();
            return $department;
        }
        return view('404');
    }
}