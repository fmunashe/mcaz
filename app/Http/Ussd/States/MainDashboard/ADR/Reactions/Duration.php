<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\Reactions;

use Sparors\Ussd\State;

class Duration extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Adverse reaction duration');
        $this->menu->paginateListing([
            'Hours',
            'Days',
            'Weeks',
            'Months',
            'Years'
        ], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2, 3, 4, 5])) {
            $this->decision->any(self::class);
            return;
        }
        if ($argument == 1) {
            $duration = $this->getDurationByName('Hours');
        } elseif ($argument == 2) {
            $duration = $this->getDurationByName('Days');
        } elseif ($argument == 3) {
            $duration = $this->getDurationByName('Weeks');
        } elseif ($argument == 4) {
            $duration = $this->getDurationByName('Months');
        } elseif ($argument == 5) {
            $duration = $this->getDurationByName('Years');
        }
        $this->record->set('durationName', $duration->duration);
        $this->record->set('durationId', $duration->id);
        $this->decision->any(DurationNumber::class);
    }

    private function getDurationByName($duration)
    {
        return \App\Models\Duration::where('duration', $duration)->first();
    }
}
