<?php


namespace App\Repositories\Interfaces\Authentication;


use App\Models\Authentication\User;

interface UserRepositoryInterface
{
    public function saveUser(User $user) : void;
}
