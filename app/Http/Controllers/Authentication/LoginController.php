<?php


namespace App\Http\Controllers\Authentication;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends AccessTokenController
{
    private $auth;
    private $response;

    public function __construct(AuthorizationServer $server, TokenRepository $tokens, Parser $jwt, Auth $auth, Response $response)
    {
        parent::__construct($server, $tokens, $jwt);
        $this->auth     = $auth;
        $this->response = $response;
    }

    public function login(ServerRequestInterface $request)
    {
        return parent::issueToken($request);
    }

    public function logout()
    {
        $user = $this->auth::user();
        $user->token()->revoke();
        return $this->response::json(['success' => true]);
    }
}
