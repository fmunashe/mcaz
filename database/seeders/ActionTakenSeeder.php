<?php

namespace Database\Seeders;

use App\Models\ActionTaken;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActionTakenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            ['id' => Str::uuid(), 'action_taken' => 'Drug withdrawn'],
            ['id' => Str::uuid(), 'action_taken' => 'Dose increased'],
            ['id' => Str::uuid(), 'action_taken' => 'Dose reduced'],
            ['id' => Str::uuid(), 'action_taken' => 'Dose not changed'],
            ['id' => Str::uuid(), 'action_taken' => 'Not applicable'],
            ['id' => Str::uuid(), 'action_taken' => 'Unknown']
        ];
        foreach ($actions as $action) {
            ActionTaken::firstOrCreate($action);
        }
    }
}
