<?php

namespace Database\Seeders;

use App\Models\ADRSeriousReason;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ADRSeriousReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            ['id' => Str::uuid(), 'reason' => 'Death'],
            ['id' => Str::uuid(), 'reason' => 'Life-threatening'],
            ['id' => Str::uuid(), 'reason' => 'Hospitalization/prolonged'],
            ['id' => Str::uuid(), 'reason' => 'Disabling'],
            ['id' => Str::uuid(), 'reason' => 'Congenital-anomaly'],
            ['id' => Str::uuid(), 'reason' => 'Other medically important condition'],
        ];

        foreach ($reasons as $reason) {
            ADRSeriousReason::firstOrCreate($reason);
        }
    }
}
