<?php

namespace App\DataTables\Dashboard;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SpecializationDataTable
{
    public static function make(Builder $query, Request $request): \Illuminate\Http\JsonResponse
    {
        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($s) => $s->created_at?->format('d/m/Y H:i'))
            ->addColumn('actions', fn ($s) => view('dashboard.clinic.specializations.datatable.actions', ['item' => $s])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }
}
