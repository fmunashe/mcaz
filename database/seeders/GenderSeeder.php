<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            ['id' => Str::uuid(), 'gender' => 'Male'],
            ['id' => Str::uuid(), 'gender' => 'Female'],
            ['id' => Str::uuid(), 'gender' => 'Other'],
        ];

        foreach ($genders as $gender) {
            Gender::firstOrCreate($gender);
        }
    }
}
