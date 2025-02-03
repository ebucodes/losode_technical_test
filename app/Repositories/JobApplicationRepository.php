<?php

namespace App\Repositories;

use App\Interfaces\JobApplicationInterface;
use App\Models\JobApplication;

class JobApplicationRepository implements JobApplicationInterface
{
    public function __construct(protected JobApplication $model) {}

    // 
    public function create(string $job_id, array $data): JobApplication
    {
        // logger(json_encode($data));
        return $this->model->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'location' => $data['location'],
            'cv_path' => $data['cv_path'],
            'job_id' => $job_id
        ]);
    }
}
