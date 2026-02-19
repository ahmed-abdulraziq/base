<?php

namespace App\DataTables\Dashboard;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PatientDataTable
{
    public static function make(Builder $query, Request $request): \Illuminate\Http\JsonResponse
    {
        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($p) => $p->created_at?->format('d/m/Y H:i'))
            ->editColumn('gender', fn ($p) => $p->gender?->label())
            ->addColumn('full_name', fn ($p) => $p->full_name)
            ->addColumn('actions', fn ($p) => view('dashboard.clinic.patients.datatable.actions', ['item' => $p])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }
}
