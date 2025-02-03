<?php

namespace App\Repositories;

use App\Models\JobListing;
use App\Interfaces\JobListingInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class JobListingRepository implements JobListingInterface
{
    public function __construct(protected JobListing $model) {}

    // 
    public function getAll(array $filters = []): Collection
    {
        $query = $this->model->newQuery();
        $query->where('user_id', Auth::user()->uuid);

        // 
        if (isset($filters['keyword'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'LIKE', "%{$filters['keyword']}%")
                    ->orWhere('category', 'LIKE', "%{$filters['keyword']}%")
                    ->orWhere('work_condition', 'LIKE', "%{$filters['keyword']}%")
                    ->orWhere('location', 'LIKE', "%{$filters['keyword']}%")
                    ->orWhere('type', 'LIKE', "%{$filters['keyword']}%");
            });
        }

        if (isset($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (isset($filters['location'])) {
            $query->where('location', 'LIKE', "%{$filters['location']}%");
        }

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        if (isset($filters['work_condition'])) {
            $query->where('work_condition', $filters['work_condition']);
        }

        return $query->get();
    }

    // 
    public function create(array $data): JobListing

    {
        return $this->model->create($data);
    }


    // 
    public function update(string $job_id, array $data): JobListing
    {
        $jobListing = $this->getById($job_id);
        // $jobListing = $this->model->where('job_ref', $id)->first();
        $jobListing->update($data);
        return $jobListing->fresh();
    }

    // 
    public function delete(string $job_id): bool
    {
        return $this->getById($job_id)->delete();
    }


    public function getById(string $job_id): ?JobListing
    {
        // return $this->model->findOrFail($id);
        return $this->model->where('user_id', Auth::user()->uuid)->where('job_ref', $job_id)->first();
    }
}
