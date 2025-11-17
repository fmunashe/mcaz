<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\Reactions;

use Sparors\Ussd\State;

class DurationNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('How many '.$this->record->get('durationName').' has the reaction been going on for');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
        }
        $this->record->set('durationNumber', $argument);
        $this->decision->any(Description::class);
    }
}
