<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Cv',
    description: 'CV file entry',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'title', type: 'string', example: 'My CV 2024'),
        new OA\Property(property: 'original_filename', type: 'string', example: 'cv-john-doe.pdf'),
        new OA\Property(property: 'mime_type', type: 'string', example: 'application/pdf'),
        new OA\Property(property: 'file_size', type: 'integer', example: 204800),
        new OA\Property(property: 'file_size_formatted', type: 'string', example: '200 KB'),
        new OA\Property(property: 'download_url', type: 'string', example: 'https://example.com/api/cvs/1/download'),
        new OA\Property(property: 'is_active', type: 'boolean', example: true),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    ]
)]
class CvResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'title'              => $this->title,
            'original_filename'  => $this->original_filename,
            'mime_type'          => $this->mime_type,
            'file_size'          => $this->file_size,
            'file_size_formatted' => $this->file_size_formatted,
            'download_url'       => route('api.cvs.download', $this->id),
            'is_active'          => (bool) $this->is_active,
            'created_at'         => $this->created_at?->toDateTimeString(),
        ];
    }
}
