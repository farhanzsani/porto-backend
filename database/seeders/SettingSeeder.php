<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'My Portfolio', 'type' => 'text', 'group' => 'general', 'description' => 'Website name'],
            ['key' => 'site_tagline', 'value' => 'Full Stack Developer & Tech Enthusiast', 'type' => 'text', 'group' => 'general', 'description' => 'Website tagline'],
            ['key' => 'site_description', 'value' => 'Portfolio and blog of a passionate full stack developer', 'type' => 'text', 'group' => 'general', 'description' => 'Website description'],
            ['key' => 'site_logo', 'value' => null, 'type' => 'file', 'group' => 'general', 'description' => 'Website logo'],
            ['key' => 'site_favicon', 'value' => null, 'type' => 'file', 'group' => 'general', 'description' => 'Website favicon'],

            // Contact
            ['key' => 'contact_email', 'value' => 'hello@example.com', 'type' => 'text', 'group' => 'contact', 'description' => 'Contact email address'],
            ['key' => 'contact_phone', 'value' => '+1 (555) 123-4567', 'type' => 'text', 'group' => 'contact', 'description' => 'Contact phone number'],
            ['key' => 'contact_location', 'value' => 'San Francisco, CA', 'type' => 'text', 'group' => 'contact', 'description' => 'Location'],

            // Social Media
            ['key' => 'social_github', 'value' => 'https://github.com/username', 'type' => 'text', 'group' => 'social', 'description' => 'GitHub profile URL'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/in/username', 'type' => 'text', 'group' => 'social', 'description' => 'LinkedIn profile URL'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/username', 'type' => 'text', 'group' => 'social', 'description' => 'Twitter profile URL'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/username', 'type' => 'text', 'group' => 'social', 'description' => 'Instagram profile URL'],
            ['key' => 'social_youtube', 'value' => '', 'type' => 'text', 'group' => 'social', 'description' => 'YouTube channel URL'],

            // Features
            ['key' => 'enable_projects', 'value' => 'true', 'type' => 'boolean', 'group' => 'features', 'description' => 'Enable projects feature'],
            ['key' => 'enable_contact_form', 'value' => 'true', 'type' => 'boolean', 'group' => 'features', 'description' => 'Enable contact form'],
            ['key' => 'items_per_page', 'value' => '12', 'type' => 'number', 'group' => 'features', 'description' => 'Number of items per page'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
