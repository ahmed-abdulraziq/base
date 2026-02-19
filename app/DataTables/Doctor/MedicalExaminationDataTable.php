<?php

namespace App\DataTables\Doctor;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicalExaminationDataTable
{
    public static function make(Builder $query, Request $request): \Illuminate\Http\JsonResponse
    {
        return DataTables::eloquent($query)
            ->editColumn('examination_date', fn ($e) => $e->examination_date?->format('d/m/Y H:i'))
            ->addColumn('patient_name', fn ($e) => $e->patient?->full_name ?? '-')
            ->addColumn('actions', fn ($e) => view('doctor.examinations.actions', ['item' => $e])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }
}
