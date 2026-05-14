<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function login(array $credentials)
    {
        return Auth::attempt($credentials);
    }
}