<?php

namespace App\Interfaces;

interface JobApplicationInterface
{
    public function create(string $job_id, array $data);
}
