<?php

namespace Database\Seeders;

use App\Models\ActionTaken;
use Illuminate\Database\Seeder;

class ActionTakenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            ['id' => 1, 'action_taken' => 'Drug withdrawn'],
            ['id' => 2, 'action_taken' => 'Dose increased'],
            ['id' => 3, 'action_taken' => 'Dose reduced'],
            ['id' => 4, 'action_taken' => 'Dose not changed'],
            ['id' => 5, 'action_taken' => 'Not applicable'],
            ['id' => 6, 'action_taken' => 'Unknown']
        ];
        foreach ($actions as $action) {
            ActionTaken::firstOrCreate($action);
        }
    }
}
