<?php


namespace App\Exceptions\Authentication;

use Illuminate\Auth\AuthenticationException as BaseAuthenticationException;
class AuthenticationException extends BaseAuthenticationException
{
    public function render()
    {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
