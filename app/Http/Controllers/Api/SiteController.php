<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SiteResource;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/site',
    summary: 'Get public site settings',
    description: 'Returns general, contact, social and feature settings. Cached for 1 hour.',
    tags: ['Site'],
    responses: [
        new OA\Response(response: 200, description: 'Site settings retrieved successfully', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: true),
            new OA\Property(property: 'message', type: 'string', example: 'Site settings retrieved successfully.'),
            new OA\Property(property: 'data', ref: '#/components/schemas/SiteSettings'),
        ])),
        new OA\Response(response: 404, description: 'Not found', content: new OA\JsonContent(properties: [
            new OA\Property(property: 'success', type: 'boolean', example: false),
            new OA\Property(property: 'message', type: 'string', example: 'Not Found.'),
        ])),
    ]
)]
class SiteController extends BaseApiController
{
    public function show(): JsonResponse
    {
        $settings = Cache::remember('api_site_settings', 3600, function () {
            return Setting::all()
                ->groupBy('group')
                ->mapWithKeys(fn ($group) => [$group->first()->group => $group->pluck('value', 'key')->all()])
                ->all();
        });

        return $this->success(new SiteResource($settings), 'Site settings retrieved successfully.');
    }
}
