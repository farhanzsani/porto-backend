<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Project',
    description: 'Project',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'slug', type: 'string', example: 'ecommerce-platform'),
        new OA\Property(property: 'title', type: 'string', example: 'E-Commerce Platform'),
        new OA\Property(property: 'description', type: 'string', example: 'A full-featured e-commerce platform with payment integration'),
        new OA\Property(property: 'content', type: 'string', description: 'HTML content, only on detail endpoint', nullable: true),
        new OA\Property(property: 'featured_image', type: 'string', nullable: true, example: '/storage/projects/featured/cover.jpg'),
        new OA\Property(property: 'client', type: 'string', nullable: true, example: 'Retail Corp'),
        new OA\Property(property: 'project_url', type: 'string', nullable: true, example: 'https://ecommerce.example.com'),
        new OA\Property(property: 'github_url', type: 'string', nullable: true, example: 'https://github.com/username/ecommerce-platform'),
        new OA\Property(property: 'view_count', type: 'integer', example: 245),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2026-08-13T10:00:00+00:00'),
        new OA\Property(
            property: 'technologies',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/Technology')
        ),
        new OA\Property(
            property: 'media',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/ProjectMedia'),
            description: 'Only on detail endpoint'
        ),
    ]
)]
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->when($this->relationLoaded('media'), $this->content),
            'featured_image' => $this->featured_image,
            'client' => $this->client,
            'project_url' => $this->project_url,
            'github_url' => $this->github_url,
            'view_count' => $this->view_count,
            'created_at' => $this->created_at?->toISOString(),
            'technologies' => TechnologyResource::collection($this->whenLoaded('technologies')),
            'media' => ProjectMediaResource::collection($this->whenLoaded('media')),
        ];
    }
}