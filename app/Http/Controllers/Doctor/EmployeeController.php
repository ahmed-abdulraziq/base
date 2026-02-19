<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreEmployeeRequest;
use App\Http\Requests\Dashboard\UpdateEmployeeRequest;
use App\Models\Employee;
use App\DataTables\Doctor\EmployeeDataTable;
use App\Services\Dashboard\EmployeeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $employeeService
    ) {
    }

    public function index(Request $request): View
    {
        $route = 'doctor.employees.data';
        return view('doctor.employees.index', compact('route'));
    }

    public function data(Request $request)
    {
        $doctorId = auth('doctor')->id();
        $query = $this->employeeService->getFilteredQuery($request, $doctorId);
        return EmployeeDataTable::make($query, $request);
    }

    public function create(): View
    {
        return view('doctor.employees.create');
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $this->employeeService->create($request->validated(), auth('doctor')->id());
        return redirect()->route('doctor.employees.index')
            ->with('success', __('translate.employee_added_pending_approval'));
    }

    public function edit(Employee $employee): View
    {
        $this->authorizeDoctorEmployee($employee);
        return view('doctor.employees.edit', compact('employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $this->authorizeDoctorEmployee($employee);
        $this->employeeService->update($employee, $request->validated());
        return redirect()->route('doctor.employees.index')
            ->with('success', __('translate.employee_edited_successfully'));
    }

    public function destroy(Employee $employee): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->authorizeDoctorEmployee($employee);
        $this->employeeService->delete($employee);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.employee_deleted_successfully')]);
        }
        return redirect()->route('doctor.employees.index')
            ->with('success', __('translate.employee_deleted_successfully'));
    }

    private function authorizeDoctorEmployee(Employee $employee): void
    {
        if ($employee->doctor_id !== auth('doctor')->id()) {
            abort(403);
        }
    }
}
