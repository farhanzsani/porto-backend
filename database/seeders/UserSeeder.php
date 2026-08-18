<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'seanyanacha@farhansani.xyz'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('nacha131204'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}