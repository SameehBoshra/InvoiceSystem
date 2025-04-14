<?php
namespace App\repositories\productRepository;

use App\Models\Product;
use App\repositories\productRepository\interfaces\iProductRepository;

class productRepository implements iProductRepository
{
    public function getAllProducts()
    {
        return Product::all();
    }
    public function getProductById($id)
    {
        $product=Product::find($id);
        if(!$product)
        {
            return view('404');
        }
        else
        return $product;
    }
    public function createProduct(array $data)
    {
        return Product::create($data);

    }
    public function updateProduct(array $data, $id)
    {

        $product = Product::find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return view('404');
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return $product;
        }
        return view('404');
    }
}