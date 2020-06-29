<?php


namespace App\Services\Interfaces\Authentication;


use App\Interfaces\Authentication\RegisterUserInterface;
use App\Models\Authentication\User;

interface RegisterServiceInterface
{
    public function registerUser(RegisterUserInterface $registerUser) : void;

    public function getUser() : User;
}
