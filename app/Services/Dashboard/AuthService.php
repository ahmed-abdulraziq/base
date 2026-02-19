<?php

namespace App\Services\Dashboard;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthService
{
    public function login(array $data): RedirectResponse
    {
        $remember = (bool) ($data['remember'] ?? false);

        if (Auth::guard('admin')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $remember)) {
            request()->session()->regenerate();
            return redirect()->intended(route('dashboard.home'));
        }

        if (Auth::guard('doctor')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $remember)) {
            $doctor = Auth::guard('doctor')->user();
            if (! $doctor->isApproved()) {
                Auth::guard('doctor')->logout();
                return back()->withErrors([
                    'email' => __('translate.doctor_pending_approval'),
                ])->withInput($data);
            }
            request()->session()->regenerate();
            return redirect()->intended(route('doctor.home'));
        }

        if (Auth::guard('employee')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $remember)) {
            $employee = Auth::guard('employee')->user();
            if (! $employee->isApproved()) {
                Auth::guard('employee')->logout();
                return back()->withErrors([
                    'email' => __('translate.employee_pending_approval'),
                ])->withInput($data);
            }
            request()->session()->regenerate();
            return redirect()->intended(route('employee.home'));
        }

        if (Auth::guard('web')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $remember)) {
            request()->session()->regenerate();
            return redirect()->intended(route('patient.home'));
        }

        return back()->withErrors([
            'email' => __('translate.invalid_credentials'),
        ])->withInput($data);
    }

    public function register(array $data): RedirectResponse
    {
        $type = $data['type'] ?? 'doctor';

        if ($type === 'doctor') {
            $doctor = Doctor::create([
                'name' => trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')),
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => $data['password'],
                'license_number' => $data['license_number'],
                'specialization_id' => $data['specialization_id'] ?? null,
                'years_of_experience' => $data['years_of_experience'] ?? null,
                'hire_date' => now(),
                'is_active' => true,
                'approved_at' => null,
            ]);

            // Notify Admins
            $admins = \App\Models\Admin::all();
            \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewDoctorRegisteredNotification($doctor));

            return redirect()->route('dashboard.login')->with('success', __('translate.doctor_registered_pending_approval'));
        }

        $gender = $data['gender'] ?? 'male';
        $gender = ($gender === 'female') ? 'female' : 'male';

        Patient::create([
            'name' => trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')),
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'password' => $data['password'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $gender,
            'address' => $data['address'] ?? null,
        ]);
        return redirect()->route('dashboard.login')->with('success', __('translate.registered_successfully'));
    }

    public function logout(): RedirectResponse
    {
        if (Auth::guard('doctor')->check()) {
            Auth::guard('doctor')->logout();
        } elseif (Auth::guard('employee')->check()) {
            Auth::guard('employee')->logout();
        } elseif (Auth::guard('patient')->check()) {
            Auth::guard('patient')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } else {
            Auth::guard('admin')->logout();
        }
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
