<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailsResource extends JsonResource
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
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar ?? 'No profile picture available yet',
            'role' => $this->role,
            'created_at' => Helper::FormatDate($this->created_at),
            'updated_at' => Helper::FormatDate($this->updated_at),
        ];
    }
}
