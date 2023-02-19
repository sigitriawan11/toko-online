<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sigit Riawan',
            'username' => 'sigit11',
            'email' => 'sigitriawan110405@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Admin'
        ]);
    }
}
