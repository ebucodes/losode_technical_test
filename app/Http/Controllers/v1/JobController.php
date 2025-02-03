<?php

namespace App\Http\Controllers\v1;

use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobListingResource;
use App\Services\JobService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(
        protected JobService $jobService
    ) {}

    // 
    // JobController.php
    public function allJobs(Request $request): JsonResponse
    {
        $filters = $request->only([
            'category',
            'location',
            'type',
            'work_condition'
        ]);

        // Add search keyword if present
        if ($request->has('q')) {
            $filters['keyword'] = $request->get('q');
        }

        $jobs = $this->jobService->getAllJobListings($filters);

        // Handle empty results
        if ($jobs->isEmpty()) {
            return Helper::ErrorResponse(
                ResponseMessages::NO_RECORDS_FOUND,
                [],
                ResponseStatusCodes::NOT_FOUND
            );
        }

        return Helper::SuccessResponse(
            ResponseMessages::ACTION_SUCCESSFUL,
            JobListingResource::collection($jobs),
            null,
            ResponseStatusCodes::SUCCESS
        );
    }
}
