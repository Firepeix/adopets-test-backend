<?php

namespace App\Providers;

use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Requests\Interfaces\Authentication\RegisterRequestInterface;
use App\Repositories\Authentication\UserRepository;
use App\Repositories\Interfaces\Authentication\UserRepositoryInterface;
use App\Services\Authentication\RegisterService;
use App\Services\Interfaces\Authentication\RegisterServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    protected $services = [
      RegisterServiceInterface::class => RegisterService::class
    ];

    protected $requests = [
        RegisterRequestInterface::class => RegisterRequest::class
    ];

    protected $repositories = [
        UserRepositoryInterface::class => UserRepository::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerServices();
        $this->registerRequests();
        $this->registerRepositories();
    }

    public function registerServices()
    {
        foreach ($this->services as $abstract => $service) {
            $this->app->bind($abstract, $service);
        }
    }

    public function registerRequests()
    {
        foreach ($this->requests as $abstract => $request) {
            $this->app->bind($abstract, $request);
        }
    }

    public function registerRepositories()
    {
        foreach ($this->repositories as $abstract => $repository) {
            $this->app->bind($abstract, $repository);
        }
    }

}
