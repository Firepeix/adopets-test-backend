<?php


namespace App\Services\Interfaces\Backoffice\Store;


use App\Interfaces\Backoffice\Store\Product\CreateProductInterface;
use App\Interfaces\Backoffice\Store\Product\UpdateProductInterface;
use App\Models\Backoffice\Store\Product;

interface ProductServiceInterface
{
    public function createProduct(CreateProductInterface $createProduct): void;

    public function updateProduct(UpdateProductInterface $updateProduct): void;

    public function findByUUID(string $uuid): void;

    public function delete(): void;

    public function getProduct(): Product;
}
