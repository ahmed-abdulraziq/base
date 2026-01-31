<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePermissionRequest;
use App\Http\Requests\Dashboard\UpdatePermissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('can:view.permissions')->only(['index', 'data']);
        $this->middleware('can:create.permission')->only(['create', 'store']);
        $this->middleware('can:edit.permission')->only(['edit', 'update']);
        $this->middleware('can:delete.permission')->only(['destroy']);
    }

    public function index(Request $request): View
    {
        $roleOptions = Role::where('guard_name', 'admin')->pluck('name', 'name')->toArray();

        return view('dashboard.settings.permissions.index', compact('roleOptions'));
    }

    public function data(Request $request)
    {
        $query = Permission::where('guard_name', 'admin')->with('roles');

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where('name', 'like', "%{$term}%");
        }
        if ($request->filled('filter_role')) {
            $query->whereHas('roles', fn ($q) => $q->where('name', $request->filter_role));
        }

        return DataTables::eloquent($query)
            ->addColumn('roles_list', function (Permission $permission) {
                return $permission->roles->pluck('name')->join(', ') ?: '-';
            })
            ->addColumn('actions', function (Permission $permission) {
                return view('dashboard.settings.permissions.datatable.actions', ['item' => $permission])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        return view('dashboard.settings.permissions.create');
    }

    public function store(StorePermissionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Permission::create($data);

        return redirect()->route('dashboard.settings.permissions.index')
            ->with('success', __('translate.permission_added_successfully'));
    }

    public function edit(Permission $permission): View
    {
        return view('dashboard.settings.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $data = $request->validated();
        $permission->update($data);

        return redirect()->route('dashboard.settings.permissions.index')
            ->with('success', __('translate.permission_edited_successfully'));
    }

    public function destroy(Permission $permission): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $permission->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.permission_deleted_successfully')]);
        }
        return redirect()->route('dashboard.settings.permissions.index')
            ->with('success', __('translate.permission_deleted_successfully'));
    }
}
