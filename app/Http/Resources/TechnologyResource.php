<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Technology',
    description: 'Technology / skill',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'slug', type: 'string', example: 'react'),
        new OA\Property(property: 'name', type: 'string', example: 'React'),
        new OA\Property(property: 'description', type: 'string', nullable: true, example: 'JavaScript library for building user interfaces'),
        new OA\Property(property: 'icon', type: 'string', nullable: true, example: 'devicon-react-original'),
        new OA\Property(property: 'color', type: 'string', nullable: true, example: '#61DAFB'),
        new OA\Property(property: 'proficiency_level', type: 'integer', example: 90),
        new OA\Property(property: 'years_experience', type: 'number', nullable: true, example: 4.0),
        new OA\Property(property: 'is_featured', type: 'boolean', example: true),
    ]
)]
class TechnologyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'icon' => $this->icon,
            'color' => $this->color,
            'proficiency_level' => $this->proficiency_level,
            'years_experience' => $this->years_experience !== null ? (float) $this->years_experience : null,
            'is_featured' => (bool) $this->is_featured,
        ];
    }
}