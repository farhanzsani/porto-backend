<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'WorkExperience',
    description: 'Work experience entry',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'company_name', type: 'string', example: 'Tech Startup Inc.'),
        new OA\Property(property: 'position', type: 'string', example: 'Senior Full Stack Developer'),
        new OA\Property(property: 'description', type: 'string', example: 'Led the development of a SaaS platform serving 10,000+ users.'),
        new OA\Property(property: 'company_logo', type: 'string', nullable: true, example: '/storage/work-experiences/logo.png'),
        new OA\Property(property: 'company_url', type: 'string', nullable: true, example: 'https://techstartup.example.com'),
        new OA\Property(property: 'location', type: 'string', nullable: true, example: 'San Francisco, CA (Remote)'),
        new OA\Property(property: 'employment_type', type: 'string', enum: ['full_time', 'part_time', 'contract', 'freelance', 'internship'], example: 'full_time'),
        new OA\Property(property: 'start_date', type: 'string', format: 'date', example: '2021-06-01'),
        new OA\Property(property: 'end_date', type: 'string', format: 'date', nullable: true, example: null),
        new OA\Property(property: 'is_current', type: 'boolean', example: true),
    ]
)]
class WorkExperienceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'position' => $this->position,
            'description' => $this->description,
            'company_logo' => $this->company_logo,
            'company_url' => $this->company_url,
            'location' => $this->location,
            'employment_type' => $this->employment_type,
            'start_date' => $this->start_date?->toDateString(),
            'end_date' => $this->end_date?->toDateString(),
            'is_current' => (bool) $this->is_current,
        ];
    }
}