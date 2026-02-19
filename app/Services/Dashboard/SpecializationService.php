<?php

namespace App\Services\Dashboard;

use App\Models\Specialization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SpecializationService
{
    public function getFilteredQuery(Request $request): Builder
    {
        $query = Specialization::query();

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('specialization_name', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%");
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

    public function create(array $data): Specialization
    {
        return Specialization::create($data);
    }

    public function update(Specialization $specialization, array $data): bool
    {
        return $specialization->update($data);
    }

    public function delete(Specialization $specialization): bool
    {
        return $specialization->delete();
    }
}
