<?php

namespace Database\Seeders;

use App\Models\WorkExperience;
use Illuminate\Database\Seeder;

class WorkExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            [
                'company_name' => 'Tech Startup Inc.',
                'position' => 'Senior Full Stack Developer',
                'description' => 'Led the development of a SaaS platform serving 10,000+ users. Architected and implemented RESTful APIs, managed database optimization, and mentored junior developers.',
                'company_logo' => null,
                'company_url' => 'https://techstartup.example.com',
                'location' => 'San Francisco, CA (Remote)',
                'employment_type' => 'full_time',
                'start_date' => '2021-06-01',
                'end_date' => null,
                'is_current' => true,
            ],
            [
                'company_name' => 'Digital Agency Co.',
                'position' => 'Full Stack Developer',
                'description' => 'Developed custom web applications for clients across various industries. Worked with Laravel, Vue.js, and MySQL to deliver scalable solutions.',
                'company_logo' => null,
                'company_url' => 'https://digitalagency.example.com',
                'location' => 'New York, NY',
                'employment_type' => 'full_time',
                'start_date' => '2019-03-01',
                'end_date' => '2021-05-31',
                'is_current' => false,
            ],
            [
                'company_name' => 'Freelance',
                'position' => 'Web Developer',
                'description' => 'Provided web development services to small businesses and startups. Built responsive websites, e-commerce platforms, and custom web applications.',
                'company_logo' => null,
                'company_url' => null,
                'location' => 'Remote',
                'employment_type' => 'freelance',
                'start_date' => '2017-01-01',
                'end_date' => '2019-02-28',
                'is_current' => false,
            ],
            [
                'company_name' => 'Software Solutions Ltd.',
                'position' => 'Junior Web Developer',
                'description' => 'Started my professional career developing internal tools and maintaining company websites. Gained experience with PHP, JavaScript, and MySQL.',
                'company_logo' => null,
                'company_url' => 'https://softwaresolutions.example.com',
                'location' => 'London, UK',
                'employment_type' => 'full_time',
                'start_date' => '2016-06-01',
                'end_date' => '2016-12-31',
                'is_current' => false,
            ],
        ];

        foreach ($experiences as $experience) {
            WorkExperience::create($experience);
        }
    }
}
