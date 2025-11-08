<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@mcaz.com', 'password' => Hash::make('password')]
        ];

        foreach ($users as $user) {
            User::query()->firstOrCreate($user);
        }
    }
}
