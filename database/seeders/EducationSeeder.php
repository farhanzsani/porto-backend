<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educations = [
            [
                'institution_name' => 'University of Technology',
                'degree' => 'Bachelor of Science',
                'field_of_study' => 'Computer Science',
                'description' => 'Focused on software engineering, data structures, algorithms, and web development. Completed several projects including a final year capstone on building a social media platform.',
                'institution_logo' => null,
                'institution_url' => 'https://university.example.com',
                'location' => 'Boston, MA',
                'start_date' => '2012-09-01',
                'end_date' => '2016-05-31',
                'is_current' => false,
                'grade' => '3.8 GPA',
            ],
            [
                'institution_name' => 'Online Learning Platform',
                'degree' => 'Professional Certificate',
                'field_of_study' => 'Full Stack Web Development',
                'description' => 'Intensive bootcamp-style program covering modern web development technologies including React, Node.js, and database design.',
                'institution_logo' => null,
                'institution_url' => 'https://onlinelearning.example.com',
                'location' => 'Online',
                'start_date' => '2015-06-01',
                'end_date' => '2015-12-31',
                'is_current' => false,
                'grade' => 'Certificate of Completion',
            ],
        ];

        foreach ($educations as $education) {
            Education::create($education);
        }
    }
}
