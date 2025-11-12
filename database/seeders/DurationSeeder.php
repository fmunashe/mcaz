<?php

namespace Database\Seeders;

use App\Models\Duration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $durations = [
            ['id' => Str::uuid(), 'duration' => 'Hours'],
            ['id' => Str::uuid(), 'duration' => 'Days'],
            ['id' => Str::uuid(), 'duration' => 'Weeks'],
            ['id' => Str::uuid(), 'duration' => 'Months'],
            ['id' => Str::uuid(), 'duration' => 'Years']
        ];

        foreach ($durations as $duration) {
            Duration::firstOrCreate($duration);
        }
    }
}
