<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            ['slug' => 'react', 'name' => 'React', 'description' => 'JavaScript library for building user interfaces', 'icon' => 'devicon-react-original', 'color' => '#61DAFB', 'proficiency_level' => 90, 'years_experience' => 4.0, 'is_featured' => true],
            ['slug' => 'vue', 'name' => 'Vue.js', 'description' => 'Progressive JavaScript framework', 'icon' => 'devicon-vuejs-plain', 'color' => '#4FC08D', 'proficiency_level' => 85, 'years_experience' => 3.5, 'is_featured' => true],
            ['slug' => 'typescript', 'name' => 'TypeScript', 'description' => 'Typed superset of JavaScript', 'icon' => 'devicon-typescript-plain', 'color' => '#3178C6', 'proficiency_level' => 88, 'years_experience' => 3.0, 'is_featured' => true],
            ['slug' => 'tailwindcss', 'name' => 'Tailwind CSS', 'description' => 'Utility-first CSS framework', 'icon' => 'devicon-tailwindcss-plain', 'color' => '#06B6D4', 'proficiency_level' => 95, 'years_experience' => 2.5, 'is_featured' => true],
            ['slug' => 'nextjs', 'name' => 'Next.js', 'description' => 'React framework for production', 'icon' => 'devicon-nextjs-original', 'color' => '#000000', 'proficiency_level' => 82, 'years_experience' => 2.0, 'is_featured' => false],
            ['slug' => 'laravel', 'name' => 'Laravel', 'description' => 'PHP web application framework', 'icon' => 'devicon-laravel-plain', 'color' => '#FF2D20', 'proficiency_level' => 92, 'years_experience' => 5.0, 'is_featured' => true],
            ['slug' => 'php', 'name' => 'PHP', 'description' => 'Server-side scripting language', 'icon' => 'devicon-php-plain', 'color' => '#777BB4', 'proficiency_level' => 90, 'years_experience' => 6.0, 'is_featured' => true],
            ['slug' => 'nodejs', 'name' => 'Node.js', 'description' => 'JavaScript runtime built on Chrome V8', 'icon' => 'devicon-nodejs-plain', 'color' => '#339933', 'proficiency_level' => 85, 'years_experience' => 4.0, 'is_featured' => true],
            ['slug' => 'express', 'name' => 'Express.js', 'description' => 'Fast, minimalist web framework for Node.js', 'icon' => 'devicon-express-original', 'color' => '#000000', 'proficiency_level' => 80, 'years_experience' => 3.5, 'is_featured' => false],
            ['slug' => 'mysql', 'name' => 'MySQL', 'description' => 'Open-source relational database', 'icon' => 'devicon-mysql-plain', 'color' => '#4479A1', 'proficiency_level' => 88, 'years_experience' => 5.0, 'is_featured' => true],
            ['slug' => 'postgresql', 'name' => 'PostgreSQL', 'description' => 'Advanced open-source relational database', 'icon' => 'devicon-postgresql-plain', 'color' => '#336791', 'proficiency_level' => 80, 'years_experience' => 3.0, 'is_featured' => false],
            ['slug' => 'mongodb', 'name' => 'MongoDB', 'description' => 'NoSQL document database', 'icon' => 'devicon-mongodb-plain', 'color' => '#47A248', 'proficiency_level' => 75, 'years_experience' => 2.5, 'is_featured' => false],
            ['slug' => 'redis', 'name' => 'Redis', 'description' => 'In-memory data structure store', 'icon' => 'devicon-redis-plain', 'color' => '#DC382D', 'proficiency_level' => 70, 'years_experience' => 2.0, 'is_featured' => false],
            ['slug' => 'docker', 'name' => 'Docker', 'description' => 'Platform for developing, shipping, and running applications', 'icon' => 'devicon-docker-plain', 'color' => '#2496ED', 'proficiency_level' => 78, 'years_experience' => 3.0, 'is_featured' => true],
            ['slug' => 'git', 'name' => 'Git', 'description' => 'Distributed version control system', 'icon' => 'devicon-git-plain', 'color' => '#F05032', 'proficiency_level' => 90, 'years_experience' => 6.0, 'is_featured' => true],
            ['slug' => 'linux', 'name' => 'Linux', 'description' => 'Unix-like operating system', 'icon' => 'devicon-linux-plain', 'color' => '#FCC624', 'proficiency_level' => 82, 'years_experience' => 4.5, 'is_featured' => false],
            ['slug' => 'vscode', 'name' => 'VS Code', 'description' => 'Code editor', 'icon' => 'devicon-vscode-plain', 'color' => '#007ACC', 'proficiency_level' => 95, 'years_experience' => 5.0, 'is_featured' => false],
            ['slug' => 'figma', 'name' => 'Figma', 'description' => 'Collaborative design tool', 'icon' => 'devicon-figma-plain', 'color' => '#F24E1E', 'proficiency_level' => 70, 'years_experience' => 2.0, 'is_featured' => false],
        ];

        foreach ($technologies as $tech) {
            Technology::create($tech);
        }
    }
}
