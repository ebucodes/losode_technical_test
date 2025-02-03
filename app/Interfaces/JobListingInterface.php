<?php

namespace App\Interfaces;

interface JobListingInterface
{

    public function getAll(array $filters = []);
    public function getById(string $job_id);
    public function create(array $data);
    public function update(string $job_id, array $data);
    public function delete(string $job_id);
}
