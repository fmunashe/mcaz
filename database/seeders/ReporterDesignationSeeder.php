<?php

namespace Database\Seeders;

use App\Models\ReporterDesignation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReporterDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            ['id' => Str::uuid(), 'designation' => 'Physician'],
            ['id' => Str::uuid(), 'designation' => 'Pharmacist'],
            ['id' => Str::uuid(), 'designation' => 'Nurse'],
            ['id' => Str::uuid(), 'designation' => 'Other health professional'],
            ['id' => Str::uuid(), 'designation' => 'Lawyer'],
            ['id' => Str::uuid(), 'designation' => 'Consumer or other non-health professional']
        ];

        foreach ($designations as $designation) {
            ReporterDesignation::firstOrCreate($designation);
        }
    }
}
