<?php


namespace App\Interfaces\Backoffice\Store\Product;


use App\Primitives\NumberPrimitive;

interface UpdateProductInterface
{
    public function getName() : ? string;
    public function getDescription() : ? string;
    public function getCategory() : ? string;
    public function getPrice() : ? NumberPrimitive;
    public function getStockAmount() : ? NumberPrimitive;
}
