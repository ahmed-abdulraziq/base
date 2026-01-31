<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreUserRequest;
use App\Http\Requests\Dashboard\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $route = 'users';
        $roleOptions = Role::where('guard_name', 'web')->pluck('name', 'name')->toArray();
        return view('dashboard.users.index', compact('route', 'roleOptions'));
    }

    public function data(Request $request)
    {
        $query = User::query()->select('users.*');

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%");
            });
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('created_at', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('created_at', '<=', $request->filter_date_to);
        }
        if ($request->filled('filter_role')) {
            $query->whereHas('roles', fn ($q) => $q->where('name', $request->filter_role));
        }

        return DataTables::eloquent($query)
            ->editColumn('created_at', function (User $user) {
                return $user->created_at?->timezone(config('app.timezone'))->format('d/m/Y H:i');
            })
            ->addColumn('role', function (User $user) {
                return $user->getRoleNames()->first() ?? '-';
            })
            ->addColumn('actions', function (User $user) {
                return view('dashboard.users.datatable.actions', ['item' => $user])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        return view('dashboard.users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
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
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
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
