<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreRoleRequest;
use App\Http\Requests\Dashboard\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\DataTables\Admin\RoleDataTable;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        return view('admin.settings.roles.index');
    }

    public function data(Request $request)
    {
        return RoleDataTable::make($request);
    }

    public function create(): View
    {
        $permissions = Permission::where('guard_name', 'admin')->orderBy('name')->get()->groupBy(function ($p) {
            $parts = explode('.', $p->name);
            return $parts[0] ?? 'other';
        });

        return view('admin.settings.roles.create', compact('permissions'));
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

        return view('admin.settings.roles.edit', compact('role', 'permissions'));
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
