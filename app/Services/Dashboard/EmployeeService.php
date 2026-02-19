<?php

namespace App\Services\Dashboard;

use App\Models\Admin;
use App\Models\Employee;
use App\Notifications\NewEmployeeAddedNotification;
use App\Notifications\RequestApprovedNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EmployeeService
{
    public function getFilteredQuery(Request $request, ?int $doctorId = null): Builder
    {
        $query = Employee::query()->with('doctor');

        if ($doctorId !== null) {
            $query->where('doctor_id', $doctorId);
        }

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
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

        return $query;
    }

    public function create(array $data, ?int $doctorId = null): Employee
    {
        if ($doctorId !== null) {
            $data['doctor_id'] = $doctorId;
            $data['approved_at'] = null;
        }

        if (isset($data['password'])) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
        }

        $employee = Employee::create($data);

        if ($doctorId !== null) {
            Notification::send(Admin::all(), new NewEmployeeAddedNotification($employee));
        }

        return $employee;
    }

    public function update(Employee $employee, array $data): bool
    {
        if (isset($data['password']) && filled($data['password'])) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $employee->update($data);
    }

    public function approve(Employee $employee): bool
    {
        if ($employee->approved_at !== null) {
            return false;
        }
        $employee->update(['approved_at' => now()]);

        if ($employee->doctor) {
            $employee->doctor->notify(new RequestApprovedNotification(
                'translate.employee_approved',
                'translate.employee_approved_message',
                route('doctor.employees.index'),
                ['name' => $employee->full_name]
            ));
        }

        return true;
    }

    public function delete(Employee $employee): bool
    {
        return $employee->delete();
    }
}
