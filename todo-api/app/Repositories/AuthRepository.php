<?php 
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;    

class AuthRepository implements AuthRepositoryInterface{
    public function register(array $data)
    {
        return User::create($data);

    }
    public function login(array $credentials)
    {
        if (!$token = auth()->attempt($credentials)) {
            return false;
        }

        return $token;
    }
}