<?php

namespace App\DataTables\Dashboard;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DoctorDataTable
{
    public static function make(Builder $query, Request $request): \Illuminate\Http\JsonResponse
    {
        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($d) => $d->created_at?->format('d/m/Y H:i'))
            ->addColumn('full_name', fn ($d) => $d->full_name)
            ->addColumn('specialization_name', fn ($d) => $d->specialization?->specialization_name ?? '-')
            ->addColumn('actions', fn ($d) => view('dashboard.clinic.doctors.datatable.actions', ['item' => $d])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }
}
