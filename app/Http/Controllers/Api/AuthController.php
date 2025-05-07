<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = $this->authService->register($request->only(['name', 'email', 'password']));

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $result = $this->authService->login($request->only(['email', 'password']));

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials are incorrect.',
                'errors'  => ['email' => ['Email or password is invalid']]
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            ...$result
        ]);
    }

    public function me()
    {
        return response()->json($this->authService->currentUser());
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
