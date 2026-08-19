<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Certificate',
    description: 'Certificate entry',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'title', type: 'string', example: 'AWS Certified Developer'),
        new OA\Property(property: 'issuing_organization', type: 'string', example: 'Amazon Web Services'),
        new OA\Property(property: 'issue_date', type: 'string', format: 'date', example: '2024-01-15'),
        new OA\Property(property: 'expiry_date', type: 'string', format: 'date', nullable: true, example: '2027-01-15'),
        new OA\Property(property: 'credential_id', type: 'string', nullable: true, example: 'ABC123XYZ'),
        new OA\Property(property: 'credential_url', type: 'string', nullable: true, example: 'https://aws.amazon.com/verification/ABC123XYZ'),
        new OA\Property(property: 'image_path', type: 'string', nullable: true, example: '/storage/certificates/aws-cert.png'),
        new OA\Property(property: 'description', type: 'string', nullable: true, example: 'Associate-level certification for AWS cloud development.'),
        new OA\Property(property: 'is_active', type: 'boolean', example: true),
        new OA\Property(property: 'is_expired', type: 'boolean', example: false),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    ]
)]
class CertificateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'title'                 => $this->title,
            'issuing_organization'  => $this->issuing_organization,
            'issue_date'            => $this->issue_date?->toDateString(),
            'expiry_date'           => $this->expiry_date?->toDateString(),
            'credential_id'         => $this->credential_id,
            'credential_url'        => $this->credential_url,
            'image_path'            => $this->image_path,
            'description'           => $this->description,
            'is_active'             => (bool) $this->is_active,
            'is_expired'            => $this->is_expired,
            'created_at'            => $this->created_at?->toDateTimeString(),
        ];
    }
}

