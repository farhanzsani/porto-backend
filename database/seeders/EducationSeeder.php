<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('educations')->truncate();

        DB::table('educations')->insert([
            [
                'institution_name' => 'Universitas Teknologi Indonesia',
                'degree'           => 'Sarjana Komputer (S.Kom)',
                'field_of_study'   => 'Teknik Informatika',
                'description'      => 'Fokus pada pengembangan perangkat lunak, rekayasa sistem, dan kecerdasan buatan. Aktif dalam organisasi mahasiswa bidang teknologi dan mengerjakan berbagai proyek riset terkait web development.',
                'institution_logo' => null,
                'institution_url'  => 'https://uti.example.ac.id',
                'location'         => 'Jakarta, Indonesia',
                'start_date'       => '2017-09-01',
                'end_date'         => '2021-08-31',
                'is_current'       => false,
                'grade'            => '3.72 GPA',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'institution_name' => 'SMK Negeri 1 Teknologi',
                'degree'           => 'Diploma',
                'field_of_study'   => 'Rekayasa Perangkat Lunak',
                'description'      => 'Mempelajari dasar-dasar pemrograman, basis data, dan pengembangan aplikasi desktop dan web.',
                'institution_logo' => null,
                'institution_url'  => null,
                'location'         => 'Bogor, Indonesia',
                'start_date'       => '2014-07-01',
                'end_date'         => '2017-06-30',
                'is_current'       => false,
                'grade'            => null,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
