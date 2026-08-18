<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Education',
    description: 'Education entry',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'institution_name', type: 'string', example: 'University of Technology'),
        new OA\Property(property: 'degree', type: 'string', example: 'Bachelor of Science'),
        new OA\Property(property: 'field_of_study', type: 'string', example: 'Computer Science'),
        new OA\Property(property: 'description', type: 'string', nullable: true, example: 'Focused on software engineering and web development.'),
        new OA\Property(property: 'institution_logo', type: 'string', nullable: true, example: '/storage/educations/logo.png'),
        new OA\Property(property: 'institution_url', type: 'string', nullable: true, example: 'https://university.example.com'),
        new OA\Property(property: 'location', type: 'string', nullable: true, example: 'Boston, MA'),
        new OA\Property(property: 'start_date', type: 'string', format: 'date', example: '2012-09-01'),
        new OA\Property(property: 'end_date', type: 'string', format: 'date', nullable: true, example: '2016-05-31'),
        new OA\Property(property: 'is_current', type: 'boolean', example: false),
        new OA\Property(property: 'grade', type: 'string', nullable: true, example: '3.8 GPA'),
    ]
)]
class EducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'institution_name' => $this->institution_name,
            'degree' => $this->degree,
            'field_of_study' => $this->field_of_study,
            'description' => $this->description,
            'institution_logo' => $this->institution_logo,
            'institution_url' => $this->institution_url,
            'location' => $this->location,
            'start_date' => $this->start_date?->toDateString(),
            'end_date' => $this->end_date?->toDateString(),
            'is_current' => (bool) $this->is_current,
            'grade' => $this->grade,
        ];
    }
}