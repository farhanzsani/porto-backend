<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TechnologyResource;
use App\Models\Technology;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/technologies',
    summary: 'List technologies',
    description: 'Returns all technologies (skills). Pass `featured=1` to only get featured ones.',
    tags: ['Technologies'],
    parameters: [
        new OA\QueryParameter(name: 'featured', description: 'Filter only featured technologies', required: false, schema: new OA\Schema(type: 'boolean')),
    ],
    responses: [
        new OA\Response(response: 200, description: 'List of technologies', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'Technologies retrieved successfully.'),
            new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Technology')),
        ])),
    ]
)]
class TechnologyController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Technology::query();

        if ($request->boolean('featured')) {
            $query->where('is_featured', true);
        }

        $technologies = $query->orderBy('name')->get();

        return $this->success(
            TechnologyResource::collection($technologies),
            'Technologies retrieved successfully.',
        );
    }
}
