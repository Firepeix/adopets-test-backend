<?php


namespace App\Repositories\Backoffice\Store;


use App\Models\Backoffice\Store\Product;
use App\Repositories\Interfaces\Backoffice\Store\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository implements ProductRepositoryInterface
{
    public function saveProduct(Product $product): void
    {
        $product->save();
    }

    public function getLastProductCreated(): Product
    {
        return Product::orderByDesc('id')->first();
    }

    public function getProductByUUID(string $uuid): Product
    {
        $product = Product::firstWhere('uuid', $uuid);
        if ($product === null) {
            # TODO ADD MISSING MODEL EXCEPTION
        }
        return $product;
    }

    public function deleteProduct(Product $product): void
    {
        $product->delete();
    }

    public function getProductsQuery(): Builder
    {
        return Product::orderByDesc('id');
    }
}
