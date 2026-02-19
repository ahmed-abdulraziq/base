<?php

namespace App\Services\Dashboard;

use App\Models\Doctor;
use App\Models\Specialization;
use App\Notifications\RequestApprovedNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DoctorService
{
    public function getFilteredQuery(Request $request): Builder
    {
        $query = Doctor::query()->with('specialization');

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%");
            });
        }
        if ($request->filled('filter_specialization')) {
            $query->where('specialization_id', $request->filter_specialization);
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('created_at', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('created_at', '<=', $request->filter_date_to);
        }

        return $query;
    }

    public function getSpecializationOptions(): array
    {
        return Specialization::pluck('specialization_name', 'id')->toArray();
    }

    public function create(array $data): Doctor
    {
        return Doctor::create($data);
    }

    public function update(Doctor $doctor, array $data): bool
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }
        return $doctor->update($data);
    }

    public function approve(Doctor $doctor): void
    {
        $doctor->update(['approved_at' => now()]);
        $doctor->notify(new RequestApprovedNotification(
            'translate.account_approved',
            'translate.account_approved_message',
            route('doctor.home')
        ));
    }

    public function delete(Doctor $doctor): bool
    {
        return $doctor->delete();
    }
}
