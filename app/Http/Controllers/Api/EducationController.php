<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EducationResource;
use App\Models\Education;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/educations',
    summary: 'List educations',
    description: 'Returns education history ordered by start date (most recent first).',
    tags: ['Education'],
    responses: [
        new OA\Response(response: 200, description: 'List of educations', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'Educations retrieved successfully.'),
            new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Education')),
        ])),
    ]
)]
class EducationController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $educations = Education::orderByDesc('start_date')->get();

        return $this->success(
            EducationResource::collection($educations),
            'Educations retrieved successfully.',
        );
    }
}
