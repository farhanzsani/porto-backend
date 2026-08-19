<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CertificateResource;
use App\Models\Certificate;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/certificates',
    summary: 'List active certificates',
    description: 'Returns all active certificates ordered by issue date (most recent first).',
    tags: ['Certificates'],
    responses: [
        new OA\Response(response: 200, description: 'List of certificates', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'Certificates retrieved successfully.'),
            new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Certificate')),
        ])),
    ]
)]
class CertificateController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $certificates = Certificate::active()->orderByDesc('issue_date')->get();

        return $this->success(
            CertificateResource::collection($certificates),
            'Certificates retrieved successfully.',
        );
    }
}

