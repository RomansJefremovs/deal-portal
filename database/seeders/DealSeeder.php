<?php

namespace Database\Seeders;

use App\Models\Deal;
use App\Models\User;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $deals = [
            ['title' => 'Gaming Laptop Sale', 'amount' => 1200, 'status' => 'new'],
            ['title' => 'Console Bundle', 'amount' => 800, 'status' => 'in_progress'],
            ['title' => 'Collectible Cards', 'amount' => 350, 'status' => 'completed'],
            ['title' => 'Gaming Chair', 'amount' => 600, 'status' => 'new'],
            ['title' => 'Mechanical Keyboard', 'amount' => 250, 'status' => 'completed'],
        ];

        foreach ($users as $index => $user) {
            foreach ($deals as $i => $deal) {
                Deal::create([
                    'user_id' => $user->id,
                    'hubspot_deal_id' => 'HS-' . ($index + 1) . '-' . ($i + 1),
                    'title' => $deal['title'],
                    'amount' => $deal['amount'],
                    'status' => $deal['status'],
                    'payload' => ['source' => 'seeder'],
                ]);
            }
        }
    }
}
