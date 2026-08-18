<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inquiries = [
            [
                'name' => 'John Anderson',
                'email' => 'john.anderson@company.com',
                'phone' => '+1 (555) 234-5678',
                'company' => 'Anderson Media',
                'budget_range' => '$5,000 - $10,000',
                'message' => 'Hello, we are looking for a developer to build a corporate website with a blog and portfolio sections. We need it to be responsive and SEO-friendly. Can we schedule a call to discuss the details?',
                'status' => 'new',
            ],
            [
                'name' => 'Maria Rodriguez',
                'email' => 'maria@startup.io',
                'phone' => null,
                'company' => 'Startup.io',
                'budget_range' => '$10,000 - $20,000',
                'message' => 'We need a RESTful API for our SaaS platform that will handle user authentication and data management. Looking for someone experienced with Laravel and MySQL. Please let me know your availability.',
                'status' => 'read',
            ],
            [
                'name' => 'David Chen',
                'email' => 'david.chen@example.com',
                'phone' => '+62 812 3456 7890',
                'company' => null,
                'budget_range' => 'Under $5,000',
                'message' => 'Hi! I want to build a mobile app for my small business. It is a simple app to showcase products and allow customers to contact us. Do you have experience with React Native?',
                'status' => 'replied',
            ],
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah.w@gmail.com',
                'phone' => null,
                'company' => 'Freelance',
                'budget_range' => null,
                'message' => 'I found your portfolio through LinkedIn. Amazing work on the e-commerce platform! I would love to discuss a potential collaboration on my upcoming project.',
                'status' => 'new',
            ],
            [
                'name' => 'Spam Bot',
                'email' => 'spam@random-site.net',
                'phone' => null,
                'company' => null,
                'budget_range' => null,
                'message' => 'Buy cheap viagra now!!! Click this link for amazing deals!!!',
                'status' => 'spam',
            ],
        ];

        foreach ($inquiries as $inquiry) {
            Inquiry::create($inquiry);
        }
    }
}