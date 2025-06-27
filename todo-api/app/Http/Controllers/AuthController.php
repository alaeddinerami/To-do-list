<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct( protected AuthService $authService )
    { }

    public function register(RegisterRequest $request)
    {
        return $this->authService->register($request->validated());
   
    }
    public function login( LoginRequest $request){
        return $this->authService->login($request->validated());
    }
}
