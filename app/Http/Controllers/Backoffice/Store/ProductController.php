<?php


namespace App\Http\Controllers\Backoffice\Store;


use App\Filters\FilterInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\Store\UpdateProductRequest;
use App\Http\Requests\Interfaces\Backoffice\Store\CreateProductRequestInterface;
use App\Repositories\Interfaces\Backoffice\Store\ProductRepositoryInterface;
use App\Services\Interfaces\Backoffice\Store\ProductServiceInterface;
use App\Transformers\Backoffice\Store\ProductTransformer;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    private $service;
    private $repository;
    private $filter;

    public function __construct(ProductServiceInterface $service, ProductRepositoryInterface $repository, Response $response, FilterInterface $filter)
    {
        parent::__construct($response);
        $this->service = $service;
        $this->repository = $repository;
        $this->filter = $filter;
    }

    public function index()
    {
        $products = $this->filter->build($this->repository->getProductsQuery())->apply();
        return $this->paginate($products, new ProductTransformer());
    }

    public function create(CreateProductRequestInterface $request)
    {
        $this->service->createProduct($request);
        $this->repository->saveProduct($this->service->getProduct());
        return $this->item($this->service->getProduct(), new ProductTransformer());
    }

    public function update(string $uuid, UpdateProductRequest $request)
    {
        $this->service->findByUUID($uuid);
        $this->service->updateProduct($request);
        $this->repository->saveProduct($this->service->getProduct());
        return $this->item($this->service->getProduct(), new ProductTransformer());
    }

    public function delete(string $uuid)
    {
        $this->service->findByUUID($uuid);
        $this->service->delete();
        return $this->getDeletedResponse();
    }
}
