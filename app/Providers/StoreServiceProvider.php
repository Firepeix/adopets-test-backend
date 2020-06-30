<?php

namespace App\Providers;

use App\Filters\Backoffice\Store\ProductFilter;
use App\Filters\FilterInterface;
use App\Http\Controllers\Backoffice\Store\ProductController;
use App\Http\Requests\Backoffice\Store\CreateProductRequest;
use App\Http\Requests\Backoffice\Store\UpdateProductRequest;
use App\Http\Requests\Interfaces\Backoffice\Store\CreateProductRequestInterface;
use App\Http\Requests\Interfaces\Backoffice\Store\UpdateProductRequestInterface;
use App\Repositories\Backoffice\Store\ProductRepository;
use App\Repositories\Interfaces\Backoffice\Store\ProductRepositoryInterface;
use App\Services\Backoffice\Store\ProductService;
use App\Services\Interfaces\Backoffice\Store\ProductServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class StoreServiceProvider extends ServiceProvider
{
    protected $services = [
        ProductServiceInterface::class => ProductService::class
    ];

    protected $requests = [
        CreateProductRequestInterface::class => CreateProductRequest::class,
        UpdateProductRequestInterface::class => UpdateProductRequest::class
    ];

    protected $repositories = [
        ProductRepositoryInterface::class => ProductRepository::class
    ];

    protected $filters = [
        ProductFilter::class => ProductController::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerServices();
        $this->registerRequests();
        $this->registerRepositories();
        $this->registerFilters();
    }

    protected function registerServices()
    {
        foreach ($this->services as $abstract => $service) {
            $this->app->bind($abstract, $service);
        }
    }

    protected function registerRequests()
    {
        foreach ($this->requests as $abstract => $request) {
            $this->app->bind($abstract, $request);
        }
    }

    protected function registerRepositories()
    {
        foreach ($this->repositories as $abstract => $repository) {
            $this->app->bind($abstract, $repository);
        }
    }

    protected function registerFilters()
    {
        foreach ($this->filters as $filter => $controller) {
            $this->app->when($controller)->needs(FilterInterface::class)->give($filter);
        }
    }

}
