<?php


namespace App\Repositories\Interfaces\Backoffice\Store;


use App\Models\Backoffice\Store\Product;
use Illuminate\Database\Eloquent\Builder;

interface ProductRepositoryInterface
{
    public function saveProduct(Product $product) : void;

    public function getLastProductCreated() : Product;

    public function getProductByUUID(string $uuid) : Product;

    public function deleteProduct(Product $product) : void;

    public function getProductsQuery() : Builder;
}
