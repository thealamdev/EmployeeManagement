<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'fname' => "Shah",
            'lname' => "Alam",
            'email' => "thealamdev@gmail.com",
            'password' => Hash::make('2125702006'),
            'role' => "super-admin",
            'status' => '1',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' =>now(),
            'deleted_at' =>null
        ]);
    }
}
