<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $technologies = [
            [
                'slug'             => 'laravel',
                'name'             => 'Laravel',
                'description'      => 'PHP web application framework with expressive, elegant syntax.',
                'icon'             => null,
                'color'            => '#FF2D20',
                'proficiency_level'=> 90,
                'years_experience' => 3.0,
                'is_featured'      => true,
            ],
            [
                'slug'             => 'php',
                'name'             => 'PHP',
                'description'      => 'Server-side scripting language designed for web development.',
                'icon'             => null,
                'color'            => '#777BB4',
                'proficiency_level'=> 88,
                'years_experience' => 4.0,
                'is_featured'      => true,
            ],
            [
                'slug'             => 'vue',
                'name'             => 'Vue.js',
                'description'      => 'Progressive JavaScript framework for building user interfaces.',
                'icon'             => null,
                'color'            => '#42B883',
                'proficiency_level'=> 80,
                'years_experience' => 2.5,
                'is_featured'      => true,
            ],
            [
                'slug'             => 'react',
                'name'             => 'React',
                'description'      => 'JavaScript library for building component-based user interfaces.',
                'icon'             => null,
                'color'            => '#61DAFB',
                'proficiency_level'=> 75,
                'years_experience' => 2.0,
                'is_featured'      => true,
            ],
            [
                'slug'             => 'mysql',
                'name'             => 'MySQL',
                'description'      => 'Open-source relational database management system.',
                'icon'             => null,
                'color'            => '#4479A1',
                'proficiency_level'=> 85,
                'years_experience' => 3.5,
                'is_featured'      => true,
            ],
            [
                'slug'             => 'tailwindcss',
                'name'             => 'Tailwind CSS',
                'description'      => 'Utility-first CSS framework for rapid UI development.',
                'icon'             => null,
                'color'            => '#06B6D4',
                'proficiency_level'=> 85,
                'years_experience' => 2.0,
                'is_featured'      => false,
            ],
            [
                'slug'             => 'docker',
                'name'             => 'Docker',
                'description'      => 'Platform for building, shipping, and running applications in containers.',
                'icon'             => null,
                'color'            => '#2496ED',
                'proficiency_level'=> 70,
                'years_experience' => 1.5,
                'is_featured'      => false,
            ],
            [
                'slug'             => 'git',
                'name'             => 'Git',
                'description'      => 'Distributed version control system for tracking changes in source code.',
                'icon'             => null,
                'color'            => '#F05032',
                'proficiency_level'=> 88,
                'years_experience' => 4.0,
                'is_featured'      => false,
            ],
            [
                'slug'             => 'rest-api',
                'name'             => 'REST API',
                'description'      => 'Architectural style for designing networked applications.',
                'icon'             => null,
                'color'            => '#009688',
                'proficiency_level'=> 85,
                'years_experience' => 3.0,
                'is_featured'      => false,
            ],
            [
                'slug'             => 'typescript',
                'name'             => 'TypeScript',
                'description'      => 'Strongly typed programming language that builds on JavaScript.',
                'icon'             => null,
                'color'            => '#3178C6',
                'proficiency_level'=> 72,
                'years_experience' => 1.5,
                'is_featured'      => false,
            ],
        ];

        foreach ($technologies as $tech) {
            DB::table('technologies')->updateOrInsert(
                ['slug' => $tech['slug']],
                array_merge($tech, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
