<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Http\Requests\Dashboard\Auth\RegisterRequest;
use App\Services\Dashboard\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        return $this->authService->login($request->validated());
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        return $this->authService->register($request->validated());
    }

    public function logout(): RedirectResponse
    {
        return $this->authService->logout();
    }

    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')
            ->redirectUrl(url('/dashboard/google/callback'))
            ->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        return $this->authService->googleLogin();
    }
}
