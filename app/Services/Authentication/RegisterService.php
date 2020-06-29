<?php


namespace App\Services\Authentication;


use App\Interfaces\Authentication\RegisterUserInterface;
use App\Models\Authentication\User;
use App\Repositories\Interfaces\Authentication\UserRepositoryInterface;
use App\Services\Interfaces\Authentication\RegisterServiceInterface;

class RegisterService implements RegisterServiceInterface
{
    private $user;
    private $repository;

    public function __construct(User $user, UserRepositoryInterface $repository)
    {
        $this->user = $user;
        $this->repository = $repository;
    }

    public function registerUser(RegisterUserInterface $registerUser): void
    {
        $this->user->register($registerUser);
        $this->repository->saveUser($this->user);
    }

    public function getUser(): User
    {
        return $this->user;
    }

}
