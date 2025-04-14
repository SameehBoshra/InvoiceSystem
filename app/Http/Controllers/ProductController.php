<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\repositories\departmentRepository\departmentRepository;
use App\repositories\productRepository\productRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productRepository;
    protected $departmentRepository;
    public function __construct(
        productRepository $productRepository ,
        departmentRepository $departmentRepository
    )
    {
         $this->productRepository=$productRepository;
         $this->departmentRepository=$departmentRepository;
    }
    public function index()
    {
        $departments=$this->departmentRepository->getAllDepartments();
        $products=$this->productRepository->getAllProducts();
        return view('products.index' ,compact('products' ,'departments'));
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        // Validate the request data
         $validatedData = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'product_name' => 'required|string|min:5|max:255|unique:departments,department_name',
            'note' => 'nullable|string|min:5|max:255',]
            ,
            [
                'department_id.required' => 'اسم القسم مطلوب',
                'department_id.exists' => 'اسم القسم غير موجود',
                'product_name.required' => 'اسم المنتج مطلوب',
                'product_name.min' => 'اسم المنتج يجب ان يكون 5 احرف على الاقل',
                'product_name.max' => 'اسم المنتج يجب ان لا يتجاوز 255 حرف',
                'product_name.unique' => 'اسم المنتج موجود مسبقا',
                'note.min' => 'وصف المنتج يجب ان يكون 5 احرف على الاقل',
                'note.max' => 'وصف المنتج يجب ان لا يتجاوز 255 حرف',

        ]);


        $product = $this->productRepository->createProduct($validatedData);

        if ($product) {
            session()->flash('Add','تم اضافة المنتج بنجاح');
            return redirect()->route('products.index');
        }

        else
        {
            session()->flash('Error','حدث خطآ ما ');
            return redirect()->back();
        }

    }

    public function update(Request $request)
    {
        $product=Product::find($request->id);
        if (!$product) {
            session()->flash('Error', 'هذا المنتج غير موجود');
            return redirect()->back();
        }
       // Validate the request data
       $validatedData = $request->validate([
        'department_id' => 'required|exists:departments,id',
        'product_name' => 'required|string|min:5|max:255|unique:departments,department_name',
        'note' => 'nullable|string|min:5|max:255',]
        ,
        [
            'department_id.required' => 'اسم القسم مطلوب',
            'department_id.exists' => 'اسم القسم غير موجود',
            'product_name.required' => 'اسم المنتج مطلوب',
            'product_name.min' => 'اسم المنتج يجب ان يكون 5 احرف على الاقل',
            'product_name.max' => 'اسم المنتج يجب ان لا يتجاوز 255 حرف',
            'product_name.unique' => 'اسم المنتج موجود مسبقا',
            'note.min' => 'وصف المنتج يجب ان يكون 5 احرف على الاقل',
            'note.max' => 'وصف المنتج يجب ان لا يتجاوز 255 حرف',

    ]);


    $product = $this->productRepository->updateProduct($validatedData ,$request->id);

    if ($product) {
        session()->flash('Update','تم تحديث المنتج بنجاح');
        return redirect()->route('products.index');
    }

    else
    {
        session()->flash('Error','حدث خطآ ما ');
        return redirect()->back();
    }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $id = Product::find($id);
        if ($id) {
            $id->delete();
            session()->flash('Delete', 'تم حذف المنتج بنجاح');
        } else {
            session()->flash('Error', 'حدث خطآ ما ');
        }
        return redirect()->route('products.index');
    }
}
