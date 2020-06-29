<?php


namespace App\Models\Backoffice\Store;


use App\Interfaces\Backoffice\Store\Product\CreateProductInterface;
use App\Interfaces\Backoffice\Store\Product\UpdateProductInterface;
use App\Models\Model;
use App\Primitives\NumberPrimitive;

class Product extends Model
{
    public function create(CreateProductInterface $createProduct): void
    {
        $this->name         = $createProduct->getName();
        $this->uuid         = $createProduct->createUUID();
        $this->description  = $createProduct->getDescription();
        $this->category     = $createProduct->getCategory();
        $this->price        = $createProduct->getPrice();
        $this->stock_amount = $createProduct->getStockAmount();
    }

    public function edit(UpdateProductInterface $updateProduct): void
    {
        $this->name         = $updateProduct->getName() ?? $this->name;
        $this->description  = $updateProduct->getDescription() ?? $this->description;
        $this->category     = $updateProduct->getCategory() ?? $this->category;
        $this->price        = $updateProduct->getPrice() ?? $this->price;
        $this->stock_amount = $updateProduct->getStockAmount() ?? $this->stock_amount;
    }

    public function getUUID(): string
    {
        return $this->uuid;
    }

    public function getId() : NumberPrimitive
    {
        return NumberPrimitive::parse($this->id);
    }


    public function getProtocol() : string
    {
        return $this->getId()->toProtocol();
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getCategory() : string
    {
        return $this->category;
    }

    public function getPrice() : NumberPrimitive
    {
        return NumberPrimitive::parse($this->price);
    }

    public function getStock() : NumberPrimitive
    {
        return NumberPrimitive::parse($this->stock_amount);
    }
}
