<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface JobListingInterface
{

    public function getAll(array $filters = []);
    public function getById(string $job_id);
    public function create(array $data);
    public function view(string $job_id);
    public function update(string $job_id, array $data);
    public function delete(string $job_id);
    public function getPaginatedApplications(string $job_id, int $perPage): LengthAwarePaginator;
}
