<?php


namespace App\Repositories\Authentication;


use App\Models\Authentication\User;
use App\Repositories\Interfaces\Authentication\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function saveUser(User $user) : void
    {
        $user->save();
    }
}
