<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\WorkExperienceResource;
use App\Models\WorkExperience;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/work-experiences',
    summary: 'List work experiences',
    description: 'Returns work history ordered by start date (most recent first).',
    tags: ['Work Experience'],
    responses: [
        new OA\Response(response: 200, description: 'List of work experiences', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'Work experiences retrieved successfully.'),
            new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/WorkExperience')),
        ])),
    ]
)]
class WorkExperienceController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $experiences = WorkExperience::orderByDesc('start_date')->get();

        return $this->success(
            WorkExperienceResource::collection($experiences),
            'Work experiences retrieved successfully.',
        );
    }
}
