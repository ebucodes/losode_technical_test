<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Services\JobApplicationService;
use Illuminate\Http\JsonResponse;

class JobApplicationController extends Controller
{
    public function __construct(
        protected JobApplicationService $jobApplicationService
    ) {}

    //
    public function store(StoreJobApplicationRequest $request, $job_id): JsonResponse
    {
        $uploadPath = public_path('uploads/cv');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        return $this->jobApplicationService->createJobApplication($job_id, $request->validated());
    }
}
