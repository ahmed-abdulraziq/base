<?php

namespace App\DataTables\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionDataTable
{
    public static function make(Request $request): \Illuminate\Http\JsonResponse
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
                return view('admin.settings.permissions.datatable.actions', ['item' => $permission])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
