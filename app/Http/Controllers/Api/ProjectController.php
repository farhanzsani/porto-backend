<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/projects',
    summary: 'List projects',
    description: 'Returns a paginated list of projects, optionally filtered by technology slug.',
    tags: ['Projects'],
    parameters: [
        new OA\QueryParameter(name: 'tech', description: 'Filter by technology slug', required: false, schema: new OA\Schema(type: 'string')),
        new OA\QueryParameter(name: 'page', description: 'Page number', required: false, schema: new OA\Schema(type: 'integer')),
        new OA\QueryParameter(name: 'per_page', description: 'Items per page (max 100)', required: false, schema: new OA\Schema(type: 'integer')),
    ],
    responses: [
        new OA\Response(response: 200, description: 'Paginated list of projects', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'Projects retrieved successfully.'),
            new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Project')),
            new OA\Property(property: 'meta', type: 'object', example: [
                'current_page' => 1,
                'last_page' => 2,
                'per_page' => 12,
                'total' => 23,
            ]),
            new OA\Property(property: 'links', type: 'object', example: [
                'first' => 'http://localhost:8000/api/projects?page=1',
                'last' => 'http://localhost:8000/api/projects?page=2',
                'prev' => null,
                'next' => 'http://localhost:8000/api/projects?page=2',
            ]),
        ])),
        new OA\Response(response: 404, description: 'Not found', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false),
            new OA\Property(property: 'message', type: 'string', example: 'Not Found.'),
        ])),
    ]
)]
#[OA\Get(
    path: '/api/projects/{slug}',
    summary: 'Get a single project',
    description: 'Returns project detail including media and technologies. Increments the view count.',
    tags: ['Projects'],
    parameters: [
        new OA\PathParameter(name: 'slug', description: 'Project slug', required: true, schema: new OA\Schema(type: 'string')),
    ],
    responses: [
        new OA\Response(response: 200, description: 'Project detail', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'Project retrieved successfully.'),
            new OA\Property(property: 'data', ref: '#/components/schemas/Project'),
        ])),
        new OA\Response(response: 404, description: 'Project not found', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false),
            new OA\Property(property: 'message', type: 'string', example: 'Project not found.'),
        ])),
    ]
)]
class ProjectController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) Setting::get('items_per_page', 12), 1), 100);

        $query = Project::query()->with('technologies');

        if ($request->filled('tech')) {
            $query->whereHas('technologies', fn ($q) => $q->where('slug', $request->string('tech')));
        }

        $projects = $query->orderByDesc('created_at')->paginate($perPage);

        return $this->success(
            ProjectResource::collection($projects),
            'Projects retrieved successfully.',
            $this->meta($projects),
            $this->links($projects),
        );
    }

    public function show(string $slug): JsonResponse
    {
        $project = Project::with(['technologies', 'media'])
            ->where('slug', $slug)
            ->first();

        if (!$project) {
            return $this->error('Project not found.', 404);
        }

        $project->increment('view_count');
        $project->refresh();

        return $this->success(new ProjectResource($project), 'Project retrieved successfully.');
    }

    protected function meta($paginator): array
    {
        return [
            'current_page' => $paginator->currentPage(),
            'from' => $paginator->firstItem(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'to' => $paginator->lastItem(),
            'total' => $paginator->total(),
        ];
    }

    protected function links($paginator): array
    {
        return [
            'first' => $paginator->url(1),
            'last' => $paginator->url($paginator->lastPage()),
            'prev' => $paginator->previousPageUrl(),
            'next' => $paginator->nextPageUrl(),
        ];
    }
}