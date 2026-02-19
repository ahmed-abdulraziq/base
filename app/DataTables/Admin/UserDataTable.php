<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserDataTable
{
    public static function make(Request $request): \Illuminate\Http\JsonResponse
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
                return view('admin.users.datatable.actions', ['item' => $user])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
