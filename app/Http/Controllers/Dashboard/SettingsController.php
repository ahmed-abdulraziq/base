<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('can:view.settings')->only(['index']);
    }

    public function index(): View
    {
        $user = auth('admin')->user();

        return view('dashboard.settings.index', compact('user'));
    }

    public function profile(): View
    {
        $user = auth('admin')->user();

        return view('dashboard.settings.profile', compact('user'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $admin = auth('admin')->user();

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $admin->name  = $validated['name'];
        $admin->email = $validated['email'];
        if (! empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }
        $admin->save();

        return redirect()->back()->with('success', __('translate.profile_updated_successfully'));
    }
}
