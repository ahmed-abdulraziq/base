<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreEmployeeRequest;
use App\Http\Requests\Dashboard\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.employees')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.employees.data';
        return view('dashboard.clinic.employees.index', compact('route'));
    }

    public function data(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('first_name', 'like', "%{$term}%")
                    ->orWhere('last_name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%")
                    ->orWhere('job_title', 'like', "%{$term}%");
            });
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('created_at', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('created_at', '<=', $request->filter_date_to);
        }

        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($e) => $e->created_at?->format('d/m/Y H:i'))
            ->addColumn('full_name', fn ($e) => $e->full_name)
            ->addColumn('actions', fn ($e) => view('dashboard.clinic.employees.datatable.actions', ['item' => $e])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        return view('dashboard.clinic.employees.create');
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        Employee::create($request->validated());
        return redirect()->route('dashboard.clinic.employees.index')
            ->with('success', __('translate.employee_added_successfully'));
    }

    public function edit(Employee $employee): View
    {
        return view('dashboard.clinic.employees.edit', compact('employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->validated());
        return redirect()->route('dashboard.clinic.employees.index')
            ->with('success', __('translate.employee_edited_successfully'));
    }

    public function destroy(Employee $employee): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $employee->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.employee_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.employees.index')
            ->with('success', __('translate.employee_deleted_successfully'));
    }
}
