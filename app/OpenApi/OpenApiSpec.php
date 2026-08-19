<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Portfolio CMS API',
    description: 'Public API consumed by the React frontend. All endpoints are public and return a consistent `{ success, message, data }` envelope.'
)]
#[OA\Server(url: L5_SWAGGER_CONST_HOST, description: 'Local server')]
#[OA\Server(url: 'http://backend.vellysianazharina.my.id', description: 'Production server')]
#[OA\Tag(name: 'Site', description: 'Public site settings')]
#[OA\Tag(name: 'Projects', description: 'Portfolio projects')]
#[OA\Tag(name: 'Technologies', description: 'Technologies / skills')]
#[OA\Tag(name: 'Work Experience', description: 'Work history')]
#[OA\Tag(name: 'Education', description: 'Education history')]
#[OA\Tag(name: 'CV', description: 'CV files for download')]
#[OA\Tag(name: 'Inquiries', description: 'Contact form submissions')]
class OpenApiSpec
{
}