<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\Interfaces\Authentication\RegisterRequestInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest implements RegisterRequestInterface
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
            'name' => ['required', 'max:191']
        ];
    }

    public function getEmail(): string
    {
        return $this->get('email');
    }

    public function getName(): string
    {
        return $this->get('name');
    }

    public function createUUID(): string
    {
        return substr(base64_encode($this->getEmail() . Carbon::now()->toDateTimeString()), 0, 10);
    }

    public function getPassword() : string
    {
        return password_hash($this->get('password'), PASSWORD_BCRYPT);
    }


}
