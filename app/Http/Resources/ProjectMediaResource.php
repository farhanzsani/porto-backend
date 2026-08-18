<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ProjectMedia',
    description: 'Media attached to a project',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'file_path', type: 'string', example: '/storage/projects/media/photo.jpg'),
        new OA\Property(property: 'file_type', type: 'string', enum: ['image', 'video', 'document'], example: 'image'),
        new OA\Property(property: 'mime_type', type: 'string', example: 'image/jpeg'),
        new OA\Property(property: 'title', type: 'string', nullable: true, example: 'Dashboard screenshot'),
    ]
)]
class ProjectMediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'file_path' => $this->file_path,
            'file_type' => $this->file_type,
            'mime_type' => $this->mime_type,
            'title' => $this->title,
        ];
    }
}