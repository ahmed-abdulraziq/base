<?php

namespace App\DataTables\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminDataTable
{
    public static function make(Builder $query, Request $request): \Illuminate\Http\JsonResponse
    {
        return DataTables::eloquent($query)
            ->editColumn('created_at', function (Admin $admin) {
                return $admin->created_at?->timezone(config('app.timezone'))->format('d/m/Y H:i');
            })
            ->addColumn('role', function (Admin $admin) {
                return $admin->role ?? '-';
            })
            ->addColumn('actions', function (Admin $admin) {
                return view('admin.admins.datatable.actions', ['item' => $admin])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
