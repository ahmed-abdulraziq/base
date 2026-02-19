<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\DataTables\Admin\AdminDataTable;
use App\Models\Admin;
use App\Services\Dashboard\AdminService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {
    }

    public function index(Request $request): View
    {
        $route = 'admins';
        $roleOptions = $this->adminService->getRoleOptions();
        return view('admin.admins.index', compact('route', 'roleOptions'));
    }

    public function data(Request $request)
    {
        $query = $this->adminService->getFilteredQuery($request);
        return AdminDataTable::make($query, $request);
    }

    public function create(): View
    {
        return view('admin.admins.create');
    }

    public function store(StoreAdminRequest $request): RedirectResponse
    {
        $this->adminService->create($request->validated());
        return redirect()->route('dashboard.admins.index')
            ->with('success', __('translate.admin_added_successfully'));
    }

    public function edit(Admin $admin): View
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, Admin $admin): RedirectResponse
    {
        $this->adminService->update($admin, $request->validated());
        return redirect()->route('dashboard.admins.index')
            ->with('success', __('translate.admin_edited_successfully'));
    }

    public function destroy(Admin $admin): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->adminService->delete($admin);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.admin_deleted_successfully')]);
        }
        return redirect()->route('dashboard.admins.index')
            ->with('success', __('translate.admin_deleted_successfully'));
    }
}
