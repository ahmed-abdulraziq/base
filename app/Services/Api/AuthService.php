<?php

namespace App\Services\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

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
    
        return $this->created('User registered successfully', $responseData);
    }
    

    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            return $this->error('Invalid credentials', [], 401);
        }
    
        /** @var \App\Models\User $user */
        $user = Auth::user();
    
        // Revoke all existing tokens for security
        $user->tokens()->delete();
        
        // Create new token
        $token = $user->createToken('api_token')->plainTextToken;
    
        return $this->success('Login successful', [
            'token' => $token,
            'user'  => new UserResource($user),
        ]);
    }
    
    

    public function logout()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if ($user) {
            $user->tokens()->delete();
        }

        return $this->success('Logged out successfully');
    }

    public function me()
    {
        return $this->success('User data retrieved', new UserResource(Auth::user()));
    }

    public function verifyEmail()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if ($user->hasVerifiedEmail()) {
            return $this->error('Email already verified', [], 400);
        }

        $user->sendEmailVerificationNotification();

        return $this->success('Verification email sent successfully');
    }

    public function changePassword(array $data)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Verify current password
        if (!Hash::check($data['current_password'], $user->password)) {
            return $this->error('Current password is incorrect', [], 400);
        }

        // Update password
        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        // Revoke all tokens for security
        $user->tokens()->delete();

        return $this->success('Password changed successfully. Please login again.');
    }

    public function updateProfile(array $data)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        return $this->success('Profile updated successfully', new UserResource($user));
    }

    public function googleLogin()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user exists with this google_id
            $user = User::where('google_id', $googleUser->getId())->first();
            
            // If user doesn't exist, check by email
            if (!$user) {
                $user = User::where('email', $googleUser->getEmail())->first();
                
                // If user exists with email but no google_id, update it
                if ($user) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                } else {
                    // Create new user
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'email_verified_at' => now(), // Google emails are verified
                    ]);
                }
            } else {
                // Update avatar in case it changed
                $user->update([
                    'avatar' => $googleUser->getAvatar(),
                ]);
            }
            
            // Revoke all existing tokens for security
            $user->tokens()->delete();
            
            // Create new token
            $token = $user->createToken('api_token')->plainTextToken;
            
            return $this->success('Login successful', [
                'token' => $token,
                'user' => new UserResource($user),
            ]);
        } catch (\Exception $e) {
            return $this->error('Google login failed: ' . $e->getMessage(), [], 400);
        }
    }
}
