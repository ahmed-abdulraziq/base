<?php

namespace App\DataTables\Dashboard;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicationDataTable
{
    public static function make(Builder $query, Request $request): \Illuminate\Http\JsonResponse
    {
        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($m) => $m->created_at?->format('d/m/Y H:i'))
            ->addColumn('actions', fn ($m) => view('dashboard.clinic.medications.datatable.actions', ['item' => $m])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }
}
