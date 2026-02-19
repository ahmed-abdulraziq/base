<?php

namespace App\DataTables\Doctor;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeDataTable
{
    public static function make(Builder $query, Request $request): \Illuminate\Http\JsonResponse
    {
        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($e) => $e->created_at?->format('d/m/Y H:i'))
            ->addColumn('full_name', fn ($e) => $e->full_name)
            ->addColumn('approval_status', fn ($e) => $e->isApproved()
                ? '<span class="badge bg-success">' . __('translate.approved') . '</span>'
                : '<span class="badge bg-warning">' . __('translate.pending_approval') . '</span>')
            ->addColumn('actions', fn ($e) => view('doctor.employees.actions', ['item' => $e])->render())
            ->rawColumns(['approval_status', 'actions'])
            ->make(true);
    }
}
