<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreEmployeeRequest;
use App\Http\Requests\Dashboard\UpdateEmployeeRequest;
use App\DataTables\Dashboard\EmployeeDataTable;
use App\Models\Employee;
use App\Services\Dashboard\EmployeeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $employeeService
    ) {
        $this->middleware('can:view.employees')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy', 'approve']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.employees.data';
        return view('dashboard.clinic.employees.index', compact('route'));
    }

    public function data(Request $request)
    {
        $query = $this->employeeService->getFilteredQuery($request);
        return EmployeeDataTable::make($query, $request);
    }

    public function create(): View
    {
        return view('dashboard.clinic.employees.create');
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $this->employeeService->create($request->validated());
        return redirect()->route('dashboard.clinic.employees.index')
            ->with('success', __('translate.employee_added_successfully'));
    }

    public function edit(Employee $employee): View
    {
        return view('dashboard.clinic.employees.edit', compact('employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $this->employeeService->update($employee, $request->validated());
        return redirect()->route('dashboard.clinic.employees.index')
            ->with('success', __('translate.employee_edited_successfully'));
    }

    public function destroy(Employee $employee): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->employeeService->delete($employee);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.employee_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.employees.index')
            ->with('success', __('translate.employee_deleted_successfully'));
    }

    public function approve(Employee $employee): RedirectResponse
    {
        if (! $this->employeeService->approve($employee)) {
            return redirect()->route('dashboard.clinic.employees.index')
                ->with('info', __('translate.employee_already_approved'));
        }
        return redirect()->route('dashboard.clinic.employees.index')
            ->with('success', __('translate.employee_approved_successfully'));
    }
}
