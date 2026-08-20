<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('certificates')->truncate();

        DB::table('certificates')->insert([
            [
                'title'                => 'Laravel Certified Developer',
                'issuing_organization' => 'Laravel',
                'issue_date'           => '2023-06-15',
                'expiry_date'          => null,
                'credential_id'        => 'LCD-2023-00142',
                'credential_url'       => 'https://laravel.com/verify/LCD-2023-00142',
                'image_path'           => null,
                'description'          => 'Sertifikasi resmi Laravel yang membuktikan kemampuan dalam membangun aplikasi web menggunakan framework Laravel.',
                'is_active'            => true,
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'title'                => 'AWS Certified Cloud Practitioner',
                'issuing_organization' => 'Amazon Web Services',
                'issue_date'           => '2023-11-20',
                'expiry_date'          => '2026-11-20',
                'credential_id'        => 'AWS-CCP-2023-78542',
                'credential_url'       => 'https://aws.amazon.com/verification/AWS-CCP-2023-78542',
                'image_path'           => null,
                'description'          => 'Sertifikasi foundational AWS yang mencakup konsep cloud, layanan inti AWS, keamanan, arsitektur, pricing, dan support.',
                'is_active'            => true,
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'title'                => 'Dicoding Backend Developer Expert',
                'issuing_organization' => 'Dicoding Indonesia',
                'issue_date'           => '2022-09-10',
                'expiry_date'          => '2025-09-10',
                'credential_id'        => 'DICODING-BDE-2022-9871',
                'credential_url'       => 'https://www.dicoding.com/certificates/DICODING-BDE-2022-9871',
                'image_path'           => null,
                'description'          => 'Menguasai pengembangan backend yang scalable menggunakan Node.js, RESTful API, database, dan deployment.',
                'is_active'            => true,
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'title'                => 'Google UX Design Certificate',
                'issuing_organization' => 'Google',
                'issue_date'           => '2022-03-05',
                'expiry_date'          => null,
                'credential_id'        => 'GOOGLE-UX-2022-44210',
                'credential_url'       => 'https://coursera.org/verify/GOOGLE-UX-2022-44210',
                'image_path'           => null,
                'description'          => 'Sertifikasi UX Design dari Google yang mencakup design thinking, wireframing, prototyping, dan user research.',
                'is_active'            => true,
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
        ]);
    }
}
