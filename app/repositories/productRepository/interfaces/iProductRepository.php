<?php
namespace App\Repositories\ProductRepository\interfaces;

interface iProductRepository
{
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct(array $data);
    public function updateProduct(array $data ,$id);
    public function deleteProduct($id);


}