<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
use App\Http\Resources\JobListingResource;
use App\Interfaces\JobListingInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobListingService
{
    public function __construct(
        protected JobListingInterface $jobListingRepository
    ) {}

    // fetch all job listings
    public function getAllJobListings(array $filters = []): JsonResponse
    {
        $items = $this->jobListingRepository->getAll($filters);
        //
        if ($items->isEmpty()) {
            return Helper::ErrorResponse(ResponseMessages::NO_RECORDS_FOUND, [], ResponseStatusCodes::NOT_FOUND);
        }

        return Helper::SuccessResponse(ResponseMessages::ACTION_SUCCESSFUL, JobListingResource::collection($items), null, ResponseStatusCodes::SUCCESS);
    }

    // create a new JobListing
    public function createJobListing(array $data): JsonResponse
    {
        try {
            //
            DB::beginTransaction();
            $data['user_id'] = Auth::user()->uuid;
            // $data['user_id'] = auth()->user->uuid;

            $newJob = $this->jobListingRepository->create($data);
            // 
            DB::commit();
            // 
            Helper::LogActivity(Auth::user()->uuid, 'Job listing created', 'Job listing created successfully');
            return Helper::SuccessResponse(ResponseMessages::JOB_CREATED, new JobListingResource($newJob), null, ResponseStatusCodes::CREATED);
        } catch (\Throwable $th) {
            //throw $th;
            logger($th);
            // 
            Helper::LogActivity(Auth::user()->uuid, 'Failed to create job listing', ' failed to create job listing');
            DB::rollBack();
            return Helper::ErrorResponse(ResponseMessages::INTERNAL_SERVER_ERROR, [], ResponseStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }



    // 
    public function updateJobListing(string $job_id, array $data)
    {
        try {
            DB::beginTransaction();
            // 
            $job = $this->jobListingRepository->getById($job_id);
            // 
            if (!$job) {
                return Helper::ErrorResponse(ResponseMessages::NO_RECORDS_FOUND, [], ResponseStatusCodes::NOT_FOUND);
            }

            $updateJob = $this->jobListingRepository->update($job_id, $data);
            // 
            Helper::LogActivity(Auth::user()->uuid, 'Job listing updated', 'Job listing updated successfully');
            DB::commit();
            return Helper::SuccessResponse(ResponseMessages::JOB_UPDATED, new JobListingResource($updateJob), null, ResponseStatusCodes::CREATED);
        } catch (\Throwable $th) {
            logger($th);
            // 
            Helper::LogActivity(Auth::user()->uuid, 'Failed to update job listing', ' failed to update job listing');
            DB::rollBack();
            return Helper::ErrorResponse(ResponseMessages::INTERNAL_SERVER_ERROR, [], ResponseStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }

    // 
    public function deleteJobListing(string $job_id): JsonResponse
    {
        try {
            DB::beginTransaction();

            // 
            $job = $this->jobListingRepository->getById($job_id);

            // 
            if (!$job) {
                return Helper::ErrorResponse(ResponseMessages::NO_RECORDS_FOUND, [], ResponseStatusCodes::NOT_FOUND);
            }

            $updateJob = [
                $this->jobListingRepository->delete($job_id),
                // JobApplication::where('job_ref', $job_id)->delete();
            ];

            // 
            Helper::LogActivity(Auth::user()->uuid, 'Job listing deleted', 'Job listing deleted successfully');
            DB::commit();
            return Helper::SuccessResponse(ResponseMessages::JOB_DELETED, [], null, ResponseStatusCodes::CREATED);
        } catch (\Throwable $th) {
            //throw $th;
            logger($th);
            Helper::LogActivity(Auth::user()->uuid, 'Failed to delete job listing', ' failed to delete job listing');
            DB::rollBack();
            return Helper::ErrorResponse(ResponseMessages::INTERNAL_SERVER_ERROR, [], ResponseStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }
}
