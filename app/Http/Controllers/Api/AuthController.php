<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ChangePasswordRequest;
use App\Http\Requests\Api\Auth\UpdateProfileRequest;
use App\Services\Api\AuthService;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends BaseController
{
    public function __construct(private AuthService $authService) {
        $this->middleware('permission:api.user.profile')->only('me');
        $this->middleware('permission:api.user.logout')->only('logout');
        $this->middleware('permission:api.user.verify.email')->only('verifyEmail');
        $this->middleware('permission:api.user.change.password')->only('changePassword');
        $this->middleware('permission:api.user.update.profile')->only('updateProfile');
    }

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

    public function verifyEmail()
    {
        return $this->authService->verifyEmail();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        return $this->authService->changePassword($request->validated());
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        return $this->authService->updateProfile($request->validated());
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        return $this->authService->googleLogin();
    }
}
