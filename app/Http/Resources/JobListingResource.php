<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->job_ref,
            "title" => $this->title,
            "company" => $this->company,
            "company_logo" => $this->company_logo ?? 'Information not available yet',
            "location" => $this->location,
            "category" => $this->category,
            "salary" => $this->salary,
            "description" => $this->description,
            "benefits" => $this->benefits ?? 'Information not available yet',
            "type" => $this->type,
            "work_condition" => $this->work_condition,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
