<?php

namespace Database\Seeders;

use App\Models\Defect;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DefectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defects = [
            ['id' => Str::uuid(), 'defect' => 'Presence of foreign material'],
            ['id' => Str::uuid(), 'defect' => 'Unusual odour'],
            ['id' => Str::uuid(), 'defect' => 'Colour Changes'],
            ['id' => Str::uuid(), 'defect' => 'Fungal Growth'],
            ['id' => Str::uuid(), 'defect' => 'Suspected Contamination'],
            ['id' => Str::uuid(), 'defect' => 'Parenteral Solution Leaks'],
            ['id' => Str::uuid(), 'defect' => 'Particulate matter'],
            ['id' => Str::uuid(), 'defect' => 'Discolouration'],
            ['id' => Str::uuid(), 'defect' => 'Wrong Label'],
            ['id' => Str::uuid(), 'defect' => 'Wrong Packaging'],
            ['id' => Str::uuid(), 'defect' => 'Wrong Strength'],
            ['id' => Str::uuid(), 'defect' => 'Lack of therapeutic response'],
            ['id' => Str::uuid(), 'defect' => 'Other']
        ];
        foreach ($defects as $defect) {
            Defect::firstOrCreate($defect);
        }
    }
}
