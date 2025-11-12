<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            ['id' => 1, 'gender' => 'Male'],
            ['id' => 2, 'gender' => 'Female'],
            ['id' => 3, 'gender' => 'Other'],
        ];

        foreach ($genders as $gender) {
            Gender::firstOrCreate($gender);
        }
    }
}
