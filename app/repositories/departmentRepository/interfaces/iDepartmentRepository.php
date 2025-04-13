<?php
namespace App\repositories\departmentRepository\interfaces;

use Illuminate\Support\Arr;

interface iDepartmentRepository
{
    public function getAllDepartments();
    public function getDepartmentById($id);
    public function createDepartment(array $data);
    public function updateDepartment(array $data ,$id);
    public function deleteDepartment($id);


}