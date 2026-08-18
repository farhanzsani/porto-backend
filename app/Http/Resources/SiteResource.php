<?php

namespace App\Http\Resources;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'SiteSettings',
    description: 'Public site settings',
    properties: [
        new OA\Property(property: 'general', type: 'object', example: [
            'site_name' => 'My Portfolio',
            'site_tagline' => 'Full Stack Developer & Tech Enthusiast',
            'site_description' => 'Portfolio and blog of a passionate full stack developer',
            'site_logo' => null,
            'site_favicon' => null,
        ]),
        new OA\Property(property: 'contact', type: 'object', example: [
            'contact_email' => 'hello@example.com',
            'contact_phone' => '+1 (555) 123-4567',
            'contact_location' => 'San Francisco, CA',
        ]),
        new OA\Property(property: 'social', type: 'object', example: [
            'github' => 'https://github.com/username',
            'linkedin' => 'https://linkedin.com/in/username',
            'twitter' => 'https://twitter.com/username',
            'instagram' => 'https://instagram.com/username',
            'youtube' => '',
        ]),
        new OA\Property(property: 'features', type: 'object', example: [
            'enable_projects' => true,
            'enable_contact_form' => true,
            'items_per_page' => 12,
        ]),
    ]
)]
class SiteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $groups = $this->resource;

        return [
            'general' => [
                'site_name' => $groups['general']['site_name'] ?? config('app.name'),
                'site_tagline' => $groups['general']['site_tagline'] ?? null,
                'site_description' => $groups['general']['site_description'] ?? null,
                'site_logo' => $groups['general']['site_logo'] ?? null,
                'site_favicon' => $groups['general']['site_favicon'] ?? null,
            ],
            'contact' => [
                'contact_email' => $groups['contact']['contact_email'] ?? null,
                'contact_phone' => $groups['contact']['contact_phone'] ?? null,
                'contact_location' => $groups['contact']['contact_location'] ?? null,
            ],
            'social' => [
                'github' => $groups['social']['social_github'] ?? null,
                'linkedin' => $groups['social']['social_linkedin'] ?? null,
                'twitter' => $groups['social']['social_twitter'] ?? null,
                'instagram' => $groups['social']['social_instagram'] ?? null,
                'youtube' => $groups['social']['social_youtube'] ?? null,
            ],
            'features' => [
                'enable_projects' => Setting::castValue($groups['features']['enable_projects'] ?? 'true', 'boolean'),
                'enable_contact_form' => Setting::castValue($groups['features']['enable_contact_form'] ?? 'true', 'boolean'),
                'items_per_page' => (int) ($groups['features']['items_per_page'] ?? 12),
            ],
        ];
    }
}