<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreRoleRequest;
use App\Http\Requests\Dashboard\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('can:view.roles')->only(['index', 'data']);
        $this->middleware('can:create.role')->only(['create', 'store']);
        $this->middleware('can:edit.role')->only(['edit', 'update']);
        $this->middleware('can:delete.role')->only(['destroy']);
    }

    public function index(Request $request): View
    {
        return view('dashboard.settings.roles.index');
    }

    public function data(Request $request)
    {
        $query = Role::where('guard_name', 'admin')->withCount('permissions');

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where('name', 'like', "%{$term}%");
        }

        return DataTables::eloquent($query)
            ->editColumn('created_at', function (Role $role) {
                return $role->created_at?->timezone(config('app.timezone'))->format('d/m/Y H:i');
            })
            ->addColumn('permissions_count', function (Role $role) {
                return $role->permissions_count ?? 0;
            })
            ->addColumn('actions', function (Role $role) {
                return view('dashboard.settings.roles.datatable.actions', ['item' => $role])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        $permissions = Permission::where('guard_name', 'admin')->orderBy('name')->get()->groupBy(function ($p) {
            $parts = explode('.', $p->name);
            return $parts[0] ?? 'other';
        });

        return view('dashboard.settings.roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $role = Role::create([
            'name'       => $data['name'],
            'guard_name' => $data['guard_name'],
        ]);
        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('dashboard.settings.roles.index')
            ->with('success', __('translate.role_added_successfully'));
    }

    public function edit(Role $role): View
    {
        if ($role->guard_name !== 'admin') {
            abort(404);
        }
        $permissions = Permission::where('guard_name', 'admin')->orderBy('name')->get()->groupBy(function ($p) {
            $parts = explode('.', $p->name);
            return $parts[0] ?? 'other';
        });
        $role->load('permissions');

        return view('dashboard.settings.roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        if ($role->guard_name !== 'admin') {
            abort(404);
        }
        $data = $request->validated();
        $role->update([
            'name'       => $data['name'],
            'guard_name' => $data['guard_name'],
        ]);
        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('dashboard.settings.roles.index')
            ->with('success', __('translate.role_edited_successfully'));
    }

    public function destroy(Role $role): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        if ($role->guard_name !== 'admin') {
            abort(404);
        }
        $role->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.role_deleted_successfully')]);
        }
        return redirect()->route('dashboard.settings.roles.index')
            ->with('success', __('translate.role_deleted_successfully'));
    }
}
