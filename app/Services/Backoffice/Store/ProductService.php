<?php


namespace App\Services\Backoffice\Store;

use App\Interfaces\Backoffice\Store\Product\CreateProductInterface;
use App\Interfaces\Backoffice\Store\Product\UpdateProductInterface;
use App\Models\Backoffice\Store\Product;
use App\Repositories\Interfaces\Backoffice\Store\ProductRepositoryInterface;
use App\Services\Interfaces\Backoffice\Store\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    private $product;
    private $repository;

    public function __construct(Product $product, ProductRepositoryInterface $repository)
    {
        $this->product = $product;
        $this->repository = $repository;
    }

    public function createProduct(CreateProductInterface $createProduct): void
    {
        $this->product->create($createProduct);
    }

    public function updateProduct(UpdateProductInterface $updateProduct): void
    {
        $this->product->edit($updateProduct);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function findByUUID(string $uuid): void
    {
        $this->product = $this->repository->getProductByUUID($uuid);
    }

    public function delete(): void
    {
        $this->repository->deleteProduct($this->product);
    }
}
