<?php


namespace App\Transformers\Authentication;


use App\Models\Authentication\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user) : array
    {
        return ['a' => 1];
    }
}
