<?php


namespace App\Interfaces\Backoffice\Store\Product;


use App\Primitives\NumberPrimitive;

interface CreateProductInterface
{
    public function getName() : string;
    public function createUUID() : string;
    public function getDescription() : string;
    public function getCategory() : string;
    public function getPrice() : NumberPrimitive;
    public function getStockAmount() : NumberPrimitive;
}
