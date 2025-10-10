<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Services\Api\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        return $this->authService->register($request->validated());
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->validated());
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    public function me()
    {
        return $this->authService->me();
    }
}
