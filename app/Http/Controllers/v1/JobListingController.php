<?php

namespace App\Http\Controllers\v1;

use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
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
    public function view(string $job_id): JsonResponse
    {
        return $this->jobListingService->viewJobListing($job_id);
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

    public function jobApplications(string $job_id, Request $request): JsonResponse
    {
        try {
            // Get pagination parameter
            $perPage = $request->get('per_page', 20);

            // Get applications
            $applications = $this->jobListingService->getJobApplications($job_id, $perPage);

            return Helper::SuccessResponse(
                ResponseMessages::ACTION_SUCCESSFUL,
                $applications,
                null,
                ResponseStatusCodes::SUCCESS
            );
        } catch (\Throwable $th) {
            return Helper::ErrorResponse(
                ResponseMessages::INTERNAL_SERVER_ERROR,
                [],
                ResponseStatusCodes::INTERNAL_SERVER_ERROR
            );
        }
    }


    protected function getPaginationLinks($paginator): array
    {
        $links = [];

        $links[] = [
            'url' => $paginator->previousPageUrl(),
            'label' => 'pagination.previous',
            'active' => false
        ];

        foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url) {
            $links[] = [
                'url' => $url,
                'label' => $page,
                'active' => $page === $paginator->currentPage()
            ];
        }

        $links[] = [
            'url' => $paginator->nextPageUrl(),
            'label' => 'pagination.next',
            'active' => false
        ];

        return $links;
    }
}
