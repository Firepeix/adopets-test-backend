<?php


namespace App\Models\Authentication;


use App\Interfaces\Authentication\RegisterUserInterface;
use App\Models\Model;

class User extends Model
{
    public function register(RegisterUserInterface $registerUser): void
    {
        $this->name     = $registerUser->getName();
        $this->email    = $registerUser->getEmail();
        $this->password = $registerUser->getPassword();
        $this->uuid     = $registerUser->createUUID();
    }

}
