<?php


namespace App\Models\Authentication;


use App\Interfaces\Authentication\RegisterUserInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    public function register(RegisterUserInterface $registerUser): void
    {
        $this->name     = $registerUser->getName();
        $this->email    = $registerUser->getEmail();
        $this->password = $registerUser->getPassword();
        $this->uuid     = $registerUser->createUUID();
    }
}
