<?php

namespace Database\Seeders;

use App\Models\ADRSeriousReason;
use Illuminate\Database\Seeder;

class ADRSeriousReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            ['id' => 1, 'reason' => 'Death'],
            ['id' => 2, 'reason' => 'Life-threatening'],
            ['id' => 3, 'reason' => 'Hospitalization/prolonged'],
            ['id' => 4, 'reason' => 'Disabling'],
            ['id' => 5, 'reason' => 'Congenital-anomaly'],
            ['id' => 6, 'reason' => 'Other medically important condition'],
        ];

        foreach ($reasons as $reason) {
            ADRSeriousReason::firstOrCreate($reason);
        }
    }
}
