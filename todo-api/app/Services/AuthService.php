<?php
namespace App\Services;

use App\Repositories\Interfaces\AuthRepositoryInterface;
class AuthService{
    public function __construct(protected AuthRepositoryInterface $authRepositoryInterface) {}

    public function register(array $data){
         try {
        $data['password'] = bcrypt($data['password']);

        $user = $this->authRepositoryInterface->register($data);

        $token = auth()->login(user: $user); 

        return response()->json([
            'message' => 'User registered successfullys',
            'user' => $user,
            'access_token' => $token,
        ], 201);
    } catch (\Exception $e) {
        logger()->error('Register failed: ' . $e->getMessage());
        return response()->json(['error' => 'Server error'], 500);
    }
    }
}