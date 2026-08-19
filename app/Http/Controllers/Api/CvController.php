<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CvResource;
use App\Models\Cv;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[OA\Get(
    path: '/api/cvs',
    summary: 'List active CVs',
    description: 'Returns all active CV files available for download.',
    tags: ['CV'],
    responses: [
        new OA\Response(response: 200, description: 'List of CVs', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'CVs retrieved successfully.'),
            new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Cv')),
        ])),
    ]
)]
class CvController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $cvs = Cv::active()->orderByDesc('created_at')->get();

        return $this->success(
            CvResource::collection($cvs),
            'CVs retrieved successfully.',
        );
    }

    #[OA\Get(
        path: '/api/cvs/{id}/download',
        summary: 'Download a CV file',
        description: 'Streams the CV file for download.',
        tags: ['CV'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'File download'),
            new OA\Response(response: 404, description: 'CV not found'),
        ]
    )]
    public function download(Cv $cv): StreamedResponse
    {
        abort_unless($cv->is_active, 404);
        abort_unless(Storage::disk('public')->exists($cv->file_path), 404);

        return Storage::disk('public')->download(
            $cv->file_path,
            $cv->original_filename,
            ['Content-Type' => $cv->mime_type]
        );
    }
}
