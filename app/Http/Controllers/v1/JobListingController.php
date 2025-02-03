<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobListingRequest;
use App\Http\Requests\UpdateJobListingRequest;
use App\Services\JobListingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function __construct(
        protected JobListingService $jobListingService
    ) {}

    // 
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only([
            'category',
            'location',
            'type',
            'work_condition'
        ]);

        // Add search query to filters if present
        if ($request->has('q')) {
            $filters['keyword'] = $request->get('q');
        }

        return $this->jobListingService->getAllJobListings($filters);
    }

    //
    public function store(StoreJobListingRequest $request): JsonResponse
    {
        return $this->jobListingService->createJobListing($request->validated());
    }

    // 
    public function update(UpdateJobListingRequest $request, string $job_id): JsonResponse
    {
        return $this->jobListingService->updateJobListing($job_id, $request->validated());
    }

    // 
    public function destroy(string $job_id): JsonResponse
    {
        return $this->jobListingService->deleteJobListing($job_id);
    }
}
