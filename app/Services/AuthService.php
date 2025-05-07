<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function register(array $data): User
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login(array $credentials): array|null
    {
        if (!JWTAuth::attempt($credentials)) {
            return null;
        }

        $token = JWTAuth::attempt($credentials);

        return [
            'token'      => $token,
            'token_type' => 'Bearer'
        ];
    }

    public function currentUser(): User
    {
        return JWTAuth::user();
    }

    public function logout(): void
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }
}
