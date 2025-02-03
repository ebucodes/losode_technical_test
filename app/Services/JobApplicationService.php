<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
use App\Http\Resources\JobApplicationResource;
use App\Interfaces\JobApplicationInterface;
use App\Models\JobListing;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobApplicationService
{
    public function __construct(
        protected JobApplicationInterface $jobApplicationRepository
    ) {}


    // create a new Job application
    public function createJobApplication(string $job_id, array $data): JsonResponse
    {
        try {

            //
            DB::beginTransaction();
            $job = JobListing::where('job_ref', $job_id)->first();
            // 
            if (!$job) {
                return Helper::ErrorResponse(ResponseMessages::NO_RECORDS_FOUND, [], ResponseStatusCodes::NOT_FOUND);
            }
            if (isset($data['cv'])) {
                $applicant = $data['first_name'] . '-' . $data['last_name'];
                $destinationPath = public_path('uploads/cv');
                $fileName = Helper::UploadFile($applicant, $data['cv'], $destinationPath);
                $data['cv_path'] = 'uploads/cv/' . $fileName;
                unset($data['cv']);
            }

            $data['job_id'] = $job_id;
            $newJob = $this->jobApplicationRepository->create($job_id, $data);
            // 
            DB::commit();
            // 
            Helper::LogActivity($data['first_name'] . '' . $data['last_name'], 'Job application submitted', ' successfully submitted job application');
            return Helper::SuccessResponse(ResponseMessages::APPLICATION_SUBMITTED, new JobApplicationResource($newJob), null, ResponseStatusCodes::CREATED);
        } catch (\Throwable $th) {
            //throw $th;
            logger($th);
            // 
            Helper::LogActivity('Guest', 'Failed to submit job application', ' failed to submitted job application');
            DB::rollBack();
            return Helper::ErrorResponse(ResponseMessages::INTERNAL_SERVER_ERROR, [], ResponseStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }
}
