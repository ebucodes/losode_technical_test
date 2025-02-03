<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
use App\Http\Resources\JobListingResource;
use App\Models\JobListing;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

class JobService
{
    public function __construct(protected JobListing $model) {}
    // fetch all job listings
    // JobService.php
    public function getAllJobListings(array $filters = []): Collection
    {
        $query = $this->model->newQuery();

        // Keyword search across multiple fields
        if (!empty($filters['keyword'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'LIKE', "%{$filters['keyword']}%")
                    ->orWhere('description', 'LIKE', "%{$filters['keyword']}%")
                    ->orWhere('category', 'LIKE', "%{$filters['keyword']}%")
                    ->orWhere('location', 'LIKE', "%{$filters['keyword']}%");
            });
        }

        // Exact match filters
        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['location'])) {
            $query->where('location', 'LIKE', "%{$filters['location']}%");
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['work_condition'])) {
            $query->where('work_condition', $filters['work_condition']);
        }

        // Return filtered results
        return $query->get();
    }
}
