<?php

namespace Database\Seeders;

use App\Models\ADROutcome;
use Illuminate\Database\Seeder;

class ADROutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $outcomes = [
            ['id' => 1, 'outcome' => 'Recovered/resolved'],
            ['id' => 2, 'outcome' => 'Recovering/resolving'],
            ['id' => 3, 'outcome' => 'Recovered/resolved with sequelae'],
            ['id' => 4, 'outcome' => 'Not recovered/not resolved'],
            ['id' => 5, 'outcome' => 'Fatal'],
            ['id' => 6, 'outcome' => 'Unknown']
        ];

        foreach ($outcomes as $outcome) {
            ADROutcome::firstOrCreate($outcome);
        }

    }
}
