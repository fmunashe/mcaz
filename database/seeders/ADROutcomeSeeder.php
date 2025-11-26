<?php

namespace Database\Seeders;

use App\Models\ADROutcome;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ADROutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $outcomes = [
            ['id' => Str::uuid(), 'outcome' => 'Recovered/resolved'],
            ['id' => Str::uuid(), 'outcome' => 'Recovering/resolving'],
            ['id' => Str::uuid(), 'outcome' => 'Recovered/resolved with sequelae'],
            ['id' => Str::uuid(), 'outcome' => 'Not recovered/not resolved'],
            ['id' => Str::uuid(), 'outcome' => 'Unknown'],
            ['id' => Str::uuid(), 'outcome' => 'Died']
        ];

        foreach ($outcomes as $outcome) {
            ADROutcome::firstOrCreate($outcome);
        }

    }
}
