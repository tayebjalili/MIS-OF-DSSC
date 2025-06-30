<?php

namespace App\Traits;

trait Sortable
{
    public function scopeSort($query, $sortField, $sortDirection)
    {
        // Handle relationships if needed
        if (str_contains($sortField, '.')) {
            $relation = explode('.', $sortField);
            return $query->with([$relation[0]])
                ->orderByPowerJoins($sortField, $sortDirection);
        }

        return $query->orderBy($sortField, $sortDirection);
    }
}
