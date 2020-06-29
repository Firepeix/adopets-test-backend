<?php


namespace App\Transformers\Backoffice\Store;

use App\Models\Backoffice\Store\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product) : array
    {
        return [
            'uuid' => $product->getUUID(),
            'protocol' => $product->getProtocol(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'category' => $product->getCategory(),
            'price' => $product->getPrice()->toInt(),
            'stock_amount' => $product->getStock()->toInt()
        ];
    }
}
