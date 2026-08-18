<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Core data first
            UserSeeder::class,
            SettingSeeder::class,

            // Technologies
            TechnologySeeder::class,

            // Experience & Education
            WorkExperienceSeeder::class,
            EducationSeeder::class,

            // Content (depends on above data)
            ProjectSeeder::class,

            // Inquiries
            InquirySeeder::class,
        ]);
    }
}
