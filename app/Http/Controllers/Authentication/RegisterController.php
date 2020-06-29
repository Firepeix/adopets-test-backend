<?php


namespace App\Http\Controllers\Authentication;


use App\Http\Controllers\Controller;
use App\Http\Requests\Interfaces\Authentication\RegisterRequestInterface;
use App\Services\Interfaces\Authentication\RegisterServiceInterface;
use App\Transformers\Authentication\UserTransformer;
use Illuminate\Support\Facades\Response;

class RegisterController extends Controller
{
    private $service;

    public function __construct(RegisterServiceInterface $service, Response $response)
    {
        parent::__construct($response);
        $this->service = $service;
    }

    public function register(RegisterRequestInterface $request)
    {
        $this->service->registerUser($request);
        return $this->item($this->service->getUser(), new UserTransformer());
    }
}
