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
#[OA\Get(
    path: '/api/certificates/{id}',
    summary: 'Get a single certificate',
    description: 'Returns a single active certificate by ID.',
    tags: ['Certificates'],
    parameters: [
        new OA\PathParameter(name: 'id', description: 'Certificate ID', required: true, schema: new OA\Schema(type: 'integer')),
    ],
    responses: [
        new OA\Response(response: 200, description: 'Certificate detail', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'Certificate retrieved successfully.'),
            new OA\Property(property: 'data', ref: '#/components/schemas/Certificate'),
        ])),
        new OA\Response(response: 404, description: 'Certificate not found', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false),
            new OA\Property(property: 'message', type: 'string', example: 'Certificate not found.'),
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

    public function show(int $id): JsonResponse
    {
        $certificate = Certificate::active()->find($id);

        if (!$certificate) {
            return $this->error('Certificate not found.', 404);
        }

        return $this->success(
            new CertificateResource($certificate),
            'Certificate retrieved successfully.',
        );
    }
}


