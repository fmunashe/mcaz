<?php

namespace Database\Seeders;

use App\Models\AdverseEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdverseEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adverseEvents = [
            ['id' => Str::uuid(), 'adverse_event' => 'Severe local reaction'],
            ['id' => Str::uuid(), 'adverse_event' => 'Seizures'],
            ['id' => Str::uuid(), 'adverse_event' => 'Abscess'],
            ['id' => Str::uuid(), 'adverse_event' => 'Sepsis'],
            ['id' => Str::uuid(), 'adverse_event' => 'Encephalopathy'],
            ['id' => Str::uuid(), 'adverse_event' => 'Toxic shock syndrome'],
            ['id' => Str::uuid(), 'adverse_event' => 'Thrombocytopenia'],
            ['id' => Str::uuid(), 'adverse_event' => 'Anaphylaxis'],
            ['id' => Str::uuid(), 'adverse_event' => 'Fever≥38°C'],
            ['id' => Str::uuid(), 'adverse_event' => 'Beyond nearest joint'],
            ['id' => Str::uuid(), 'adverse_event' => 'Febrile'],
            ['id' => Str::uuid(), 'adverse_event' => 'Afebrile'],
            ['id' => Str::uuid(), 'adverse_event' => 'Other']
        ];

        foreach ($adverseEvents as $adverseEvent) {
            AdverseEvent::firstOrCreate($adverseEvent);
        }
    }
}
