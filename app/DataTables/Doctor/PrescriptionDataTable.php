<?php

namespace App\DataTables\Doctor;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PrescriptionDataTable
{
    public static function make(Builder $query, Request $request): \Illuminate\Http\JsonResponse
    {
        return DataTables::eloquent($query)
            ->editColumn('prescription_date', fn ($p) => $p->prescription_date?->format('d/m/Y H:i'))
            ->addColumn('patient_name', fn ($p) => $p->patient?->full_name ?? '-')
            ->addColumn('doctor_name', fn ($p) => $p->doctor?->full_name ?? '-')
            ->addColumn('actions', fn ($p) => view('doctor.prescriptions.actions', ['item' => $p])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }
}
