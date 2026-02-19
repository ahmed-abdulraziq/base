<?php

namespace App\DataTables\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleDataTable
{
    public static function make(Request $request): \Illuminate\Http\JsonResponse
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
                return view('admin.settings.roles.datatable.actions', ['item' => $role])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
