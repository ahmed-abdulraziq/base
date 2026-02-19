<?php

namespace App\Services\Dashboard;

use App\Models\Medication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MedicationService
{
    public function getFilteredQuery(Request $request): Builder
    {
        $query = Medication::query();

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('medication_name', 'like', "%{$term}%")
                    ->orWhere('generic_name', 'like', "%{$term}%")
                    ->orWhere('manufacturer', 'like', "%{$term}%");
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

    public function create(array $data): Medication
    {
        return Medication::create($data);
    }

    public function update(Medication $medication, array $data): bool
    {
        return $medication->update($data);
    }

    public function delete(Medication $medication): bool
    {
        return $medication->delete();
    }
}
