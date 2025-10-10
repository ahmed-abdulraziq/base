<?php

namespace App\Services\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use ApiResponseTrait;

    public function register(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    
        $token = $user->createToken('auth_token')->plainTextToken;

        $responseData = [
            'user'  => new UserResource($user),
            'token' => $token,
        ];
    
        return $this->success('User registered successfully', $responseData, 201);
    }
    

    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            return $this->error('Invalid credentials', [], 401);
        }
    
        /** @var \App\Models\User $user */
        $user = Auth::user();
    
        // Check if the user already has a token
        $existingToken = $user->tokens()->where('name', 'api_token')->first();
    
        if ($existingToken) {
            $token = $existingToken->plainTextToken ?? $existingToken->id . '|' . $existingToken->token;
        } else {
            // Create new token only if none exists
            $token = $user->createToken('api_token')->plainTextToken;
        }
    
        return $this->success('Login successful', [
            'token' => $token,
            'user'  => new UserResource($user),
        ]);
    }
    
    

    public function logout()
    {
        Auth::user()?->currentAccessToken()?->delete();

        return $this->success('Logged out successfully');
    }

    public function me()
    {
        return $this->success('User data retrieved', new UserResource(Auth::user()));
    }
}
