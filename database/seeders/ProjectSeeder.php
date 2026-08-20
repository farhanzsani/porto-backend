<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('project_technology')->truncate();
        DB::table('project_media')->truncate();
        DB::table('projects')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $projects = [
            [
                'title'        => 'Portfolio CMS Backend',
                'slug'         => 'portfolio-cms-backend',
                'description'  => 'Backend CMS untuk portfolio personal berbasis Laravel dengan REST API, admin panel, dan manajemen konten lengkap.',
                'content'      => '<p>Sistem backend yang dibangun menggunakan Laravel 11 untuk mengelola konten portfolio. Dilengkapi dengan admin panel berbasis Blade, REST API untuk frontend React, manajemen project, sertifikat, CV, dan sistem inquiry.</p><p>Fitur utama meliputi upload file, manajemen media, soft deletes, dan dokumentasi API menggunakan Swagger.</p>',
                'featured_image' => null,
                'client'       => null,
                'project_url'  => null,
                'github_url'   => 'https://github.com/example/portfolio-backend',
                'view_count'   => 0,
                'technologies' => ['laravel', 'php', 'mysql', 'rest-api'],
            ],
            [
                'title'        => 'E-Commerce Platform',
                'slug'         => 'e-commerce-platform',
                'description'  => 'Platform e-commerce lengkap dengan fitur keranjang belanja, payment gateway, manajemen produk, dan dashboard analitik.',
                'content'      => '<p>Dibangun menggunakan Laravel sebagai backend dan Vue.js sebagai frontend. Integrasi dengan Midtrans untuk payment gateway, fitur real-time notification menggunakan Pusher, dan sistem laporan penjualan.</p><p>Menangani lebih dari 500 transaksi per hari dengan arsitektur yang scalable.</p>',
                'featured_image' => null,
                'client'       => 'PT Toko Online Indonesia',
                'project_url'  => 'https://toko-online.example.com',
                'github_url'   => null,
                'view_count'   => 0,
                'technologies' => ['laravel', 'php', 'vue', 'mysql', 'tailwindcss'],
            ],
            [
                'title'        => 'HR Management System',
                'slug'         => 'hr-management-system',
                'description'  => 'Sistem manajemen SDM untuk pengelolaan karyawan, absensi, penggajian, dan evaluasi kinerja.',
                'content'      => '<p>Aplikasi web enterprise untuk departemen HR yang mencakup modul rekrutmen, onboarding, absensi berbasis QR code, penggajian otomatis, dan sistem penilaian kinerja 360 derajat.</p><p>Diintegrasikan dengan BPJS Ketenagakerjaan API dan sistem bank untuk transfer gaji otomatis.</p>',
                'featured_image' => null,
                'client'       => 'CV Digital Kreatif',
                'project_url'  => null,
                'github_url'   => null,
                'view_count'   => 0,
                'technologies' => ['laravel', 'php', 'mysql', 'rest-api', 'docker'],
            ],
            [
                'title'        => 'Task Management App',
                'slug'         => 'task-management-app',
                'description'  => 'Aplikasi manajemen tugas berbasis web dengan fitur kolaborasi tim, Kanban board, dan tracking deadline.',
                'content'      => '<p>Dibangun dengan React untuk frontend dan Laravel API sebagai backend. Fitur real-time update menggunakan WebSocket, drag-and-drop Kanban board, notifikasi email, dan laporan produktivitas tim.</p>',
                'featured_image' => null,
                'client'       => null,
                'project_url'  => 'https://taskapp.example.com',
                'github_url'   => 'https://github.com/example/task-management',
                'view_count'   => 0,
                'technologies' => ['react', 'laravel', 'mysql', 'typescript', 'tailwindcss'],
            ],
            [
                'title'        => 'Blog & Content Platform',
                'slug'         => 'blog-content-platform',
                'description'  => 'Platform blog modern dengan fitur CMS, SEO optimization, dan sistem komentar.',
                'content'      => '<p>Platform blogging yang dibangun dengan Laravel dan Tailwind CSS. Fitur utama meliputi rich text editor, manajemen kategori dan tag, optimasi SEO otomatis, sitemap generator, dan sistem komentar dengan moderasi.</p>',
                'featured_image' => null,
                'client'       => null,
                'project_url'  => null,
                'github_url'   => 'https://github.com/example/blog-platform',
                'view_count'   => 0,
                'technologies' => ['laravel', 'php', 'mysql', 'tailwindcss'],
            ],
        ];

        foreach ($projects as $project) {
            $techSlugs = $project['technologies'];
            unset($project['technologies']);

            $projectId = DB::table('projects')->insertGetId(array_merge($project, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            // Attach technologies
            $techIds = DB::table('technologies')
                ->whereIn('slug', $techSlugs)
                ->pluck('id');

            foreach ($techIds as $techId) {
                DB::table('project_technology')->insert([
                    'project_id'    => $projectId,
                    'technology_id' => $techId,
                ]);
            }
        }
    }
}
