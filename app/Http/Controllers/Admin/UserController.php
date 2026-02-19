<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreUserRequest;
use App\Http\Requests\Dashboard\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $route = 'users';
        $roleOptions = Role::where('guard_name', 'web')->pluck('name', 'name')->toArray();
        return view('admin.users.index', compact('route', 'roleOptions'));
    }

    public function data(Request $request)
    {
        return UserDataTable::make($request);
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        User::create($data);
        return redirect()->route('dashboard.users.index')
            ->with('success', __('translate.user_added_successfully'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('dashboard.users.index')
            ->with('success', __('translate.user_edited_successfully'));
    }

    public function destroy(User $user): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $user->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.user_deleted_successfully')]);
        }
        return redirect()->route('dashboard.users.index')
            ->with('success', __('translate.user_deleted_successfully'));
    }
}
