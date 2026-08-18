<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'ecommerce-platform',
                'title' => 'E-Commerce Platform',
                'description' => 'A full-featured e-commerce platform with payment integration and inventory management',
                'content' => '<h2>Project Overview</h2><p>Built a comprehensive e-commerce solution for a retail client that processes over 1000 orders per day.</p><h3>Key Features</h3><ul><li>Multi-vendor support</li><li>Real-time inventory tracking</li><li>Stripe payment integration</li><li>Advanced product filtering</li><li>Order management dashboard</li></ul><h3>Technical Highlights</h3><p>Implemented using Laravel for the backend API, React for the admin dashboard, and Vue.js for the customer-facing storefront. Used Redis for caching and queue management.</p>',
                'featured_image' => null,
                'client' => 'Retail Corp',
                'project_url' => 'https://ecommerce.example.com',
                'github_url' => 'https://github.com/username/ecommerce-platform',
                'view_count' => 245,
                'technologies' => ['laravel', 'react', 'mysql', 'redis', 'tailwindcss'],
            ],
            [
                'slug' => 'task-management-app',
                'title' => 'Task Management Application',
                'description' => 'Collaborative task management tool with real-time updates and team collaboration features',
                'content' => '<h2>About the Project</h2><p>A modern task management application designed for remote teams to collaborate effectively.</p><h3>Features</h3><ul><li>Real-time collaboration using WebSockets</li><li>Kanban board interface</li><li>Time tracking and reporting</li><li>File attachments</li><li>Email notifications</li></ul><h3>Technology Stack</h3><p>Built with Laravel backend, Vue.js frontend, and MySQL database. Implemented WebSocket connections using Laravel Echo and Pusher.</p>',
                'featured_image' => null,
                'client' => null,
                'project_url' => 'https://taskapp.example.com',
                'github_url' => 'https://github.com/username/task-app',
                'view_count' => 189,
                'technologies' => ['laravel', 'vue', 'mysql', 'docker', 'tailwindcss'],
            ],
            [
                'slug' => 'portfolio-website',
                'title' => 'Creative Portfolio Website',
                'description' => 'A beautiful portfolio website for a creative agency showcasing their work',
                'content' => '<h2>Project Description</h2><p>Designed and developed a stunning portfolio website for a creative agency.</p><h3>Highlights</h3><ul><li>Custom animations and transitions</li><li>Responsive grid gallery</li><li>CMS integration for easy updates</li><li>Contact form with validation</li><li>SEO optimized</li></ul>',
                'featured_image' => null,
                'client' => 'Creative Agency XYZ',
                'project_url' => 'https://agency.example.com',
                'github_url' => null,
                'view_count' => 156,
                'technologies' => ['php', 'nextjs', 'tailwindcss', 'postgresql'],
            ],
            [
                'slug' => 'api-gateway-service',
                'title' => 'Microservices API Gateway',
                'description' => 'Scalable API gateway for managing microservices architecture',
                'content' => '<h2>Technical Project</h2><p>Built a robust API gateway to handle authentication, rate limiting, and routing for a microservices architecture.</p><h3>Key Components</h3><ul><li>JWT authentication</li><li>Rate limiting and throttling</li><li>Service discovery</li><li>Load balancing</li><li>Logging and monitoring</li></ul>',
                'featured_image' => null,
                'client' => 'Tech Startup Inc.',
                'project_url' => null,
                'github_url' => 'https://github.com/username/api-gateway',
                'view_count' => 312,
                'technologies' => ['nodejs', 'express', 'redis', 'docker', 'mongodb'],
            ],
            [
                'slug' => 'blog-cms',
                'title' => 'Custom Blog CMS',
                'description' => 'A lightweight and fast content management system for bloggers',
                'content' => '<h2>CMS Project</h2><p>Developed a custom CMS focused on simplicity and performance for content creators.</p>',
                'featured_image' => null,
                'client' => null,
                'project_url' => 'https://blogcms.example.com',
                'github_url' => 'https://github.com/username/blog-cms',
                'view_count' => 98,
                'technologies' => ['laravel', 'vue', 'mysql', 'tailwindcss'],
            ],
        ];

        foreach ($projects as $projectData) {
            $techSlugs = $projectData['technologies'];
            unset($projectData['technologies']);

            $project = Project::create($projectData);

            // Attach technologies
            $technologies = Technology::whereIn('slug', $techSlugs)->get();
            $project->technologies()->attach($technologies->pluck('id'));
        }
    }
}
