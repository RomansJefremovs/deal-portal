<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'John Smith', 'email' => 'john@example.com'],
            ['name' => 'Anna Kowalski', 'email' => 'anna@example.com'],
            ['name' => 'Peter Müller', 'email' => 'peter@example.com'],
        ];

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'),
            ]);
        }
    }
}
