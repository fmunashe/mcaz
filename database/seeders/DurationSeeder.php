<?php

namespace Database\Seeders;

use App\Models\Duration;
use Illuminate\Database\Seeder;

class DurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $durations = [
            ['id' => 1, 'duration' => 'Hours'],
            ['id' => 2, 'duration' => 'Days'],
            ['id' => 3, 'duration' => 'Weeks'],
            ['id' => 4, 'duration' => 'Months'],
            ['id' => 5, 'duration' => 'Years']
        ];

        foreach ($durations as $duration) {
            Duration::firstOrCreate($duration);
        }
    }
}
