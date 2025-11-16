<?php

namespace Database\Seeders;

use App\Models\AgeGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ageGroups = [
            ['id' => Str::uuid(), 'age_group' => 'less than 1 year'],
            ['id' => Str::uuid(), 'age_group' => '1-5 years'],
            ['id' => Str::uuid(), 'age_group' => '6-18 years'],
            ['id' => Str::uuid(), 'age_group' => '19-60 years'],
            ['id' => Str::uuid(), 'age_group' => '61 years and above'],
        ];

        foreach ($ageGroups as $ageGroup) {
            AgeGroup::firstOrCreate($ageGroup);
        }
    }
}
