<?php

namespace App\Services\Dashboard;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthService
{
    public function login(array $data): RedirectResponse
    {
        $remember = $data['remember'] ?? false;

        if (! Auth::guard('admin')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $remember)) {
            return back()->withErrors([
                'email' => __('translate.invalid_credentials'),
            ])->withInput($data);
        }

        request()->session()->regenerate();

        return redirect()->intended(route('dashboard.home'));
    }

    public function register(array $data): RedirectResponse
    {
        Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('dashboard.login')->with('success', __('translate.registered_successfully'));
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard.login');
    }

    public function googleLogin(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $admin = Admin::where('google_id', $googleUser->getId())->first();

            if (! $admin) {
                $admin = Admin::where('email', $googleUser->getEmail())->first();

                if ($admin) {
                    $admin->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                } else {
                    $admin = Admin::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'email_verified_at' => now(),
                    ]);
                }
            } else {
                $admin->update([
                    'avatar' => $googleUser->getAvatar(),
                ]);
            }

            Auth::guard('admin')->login($admin, true);
            request()->session()->regenerate();

            return redirect()->intended(route('dashboard.home'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.login')->withErrors([
                'email' => __('translate.google_login_failed'),
            ]);
        }
    }
}
