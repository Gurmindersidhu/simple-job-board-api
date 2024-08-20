<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'job_id' => $this->job_id,
            'title' => $this->title,
            'description' => $this->description,
            'company' => $this->company,
            'salary' => $this->salary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'post_by' => [
                'user_id' => $this->user->user_id,
                'name' => $this->user->name
            ]
        ];
    }
}
