<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkExperienceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('work_experiences')->truncate();

        DB::table('work_experiences')->insert([
            [
                'company_name'    => 'PT Teknologi Nusantara',
                'position'        => 'Backend Developer',
                'description'     => 'Mengembangkan dan memelihara aplikasi web berbasis Laravel untuk kebutuhan internal perusahaan. Bertanggung jawab atas desain arsitektur API, optimasi query database, dan integrasi dengan layanan pihak ketiga seperti payment gateway dan SMS gateway.',
                'company_logo'    => null,
                'company_url'     => 'https://example.com',
                'location'        => 'Jakarta, Indonesia',
                'employment_type' => 'full_time',
                'start_date'      => '2023-03-01',
                'end_date'        => null,
                'is_current'      => true,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'company_name'    => 'CV Digital Kreatif',
                'position'        => 'Full Stack Developer',
                'description'     => 'Membangun aplikasi web end-to-end menggunakan Laravel sebagai backend dan Vue.js sebagai frontend. Terlibat dalam pengembangan fitur e-commerce, sistem manajemen konten, dan dashboard analitik real-time untuk berbagai klien.',
                'company_logo'    => null,
                'company_url'     => 'https://digitalkreatif.example.com',
                'location'        => 'Bandung, Indonesia',
                'employment_type' => 'full_time',
                'start_date'      => '2021-06-01',
                'end_date'        => '2023-02-28',
                'is_current'      => false,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'company_name'    => 'Freelance',
                'position'        => 'Web Developer',
                'description'     => 'Mengerjakan berbagai proyek freelance untuk klien lokal dan internasional. Proyek meliputi pembuatan landing page, company profile, sistem manajemen sederhana, dan integrasi API.',
                'company_logo'    => null,
                'company_url'     => null,
                'location'        => 'Remote',
                'employment_type' => 'freelance',
                'start_date'      => '2020-01-01',
                'end_date'        => '2021-05-31',
                'is_current'      => false,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
