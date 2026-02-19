<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePermissionRequest;
use App\Http\Requests\Dashboard\UpdatePermissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\DataTables\Admin\PermissionDataTable;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        return view('admin.settings.permissions.index', compact('roleOptions'));
    }

    public function data(Request $request)
    {
        return PermissionDataTable::make($request);
    }

    public function create(): View
    {
        return view('admin.settings.permissions.create');
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
        return view('admin.settings.permissions.edit', compact('permission'));
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
