<?php

namespace App\DataTables\Dashboard;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AppointmentDataTable
{
    public static function make(Builder $query, Request $request): \Illuminate\Http\JsonResponse
    {
        return DataTables::eloquent($query)
            ->editColumn('appointment_date', fn ($a) => $a->appointment_date?->format('d/m/Y'))
            ->editColumn('status', fn ($a) => $a->status?->label())
            ->addColumn('patient_name', fn ($a) => $a->patient?->full_name ?? '-')
            ->addColumn('doctor_name', fn ($a) => $a->doctor?->full_name ?? '-')
            ->addColumn('actions', fn ($a) => view('dashboard.clinic.appointments.datatable.actions', ['item' => $a])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }
}
