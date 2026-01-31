<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        $route = 'admins';
        $roleOptions = Role::where('guard_name', 'admin')->pluck('name', 'name')->toArray();
        return view('dashboard.admins.index', compact('route', 'roleOptions'));
    }

    public function data(Request $request)
    {
        $query = Admin::query()->select('admins.*');

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
            ->editColumn('created_at', function (Admin $admin) {
                return $admin->created_at?->timezone(config('app.timezone'))->format('d/m/Y H:i');
            })
            ->addColumn('role', function (Admin $admin) {
                return $admin->role ?? '-';
            })
            ->addColumn('actions', function (Admin $admin) {
                return view('dashboard.admins.datatable.actions', ['item' => $admin])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        return view('dashboard.admins.create');
    }

    public function store(StoreAdminRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        Admin::create($data);
        return redirect()->route('dashboard.admins.index')
            ->with('success', __('translate.admin_added_successfully'));
    }

    public function edit(Admin $admin): View
    {
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, Admin $admin): RedirectResponse
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $admin->update($data);
        return redirect()->route('dashboard.admins.index')
            ->with('success', __('translate.admin_edited_successfully'));
    }

    public function destroy(Admin $admin): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $admin->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.admin_deleted_successfully')]);
        }
        return redirect()->route('dashboard.admins.index')
            ->with('success', __('translate.admin_deleted_successfully'));
    }
}
