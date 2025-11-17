<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications;

use Sparors\Ussd\State;

class Frequency extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter frequency '.$this->record->get('medicationCount').' of current medication dose');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('medicationCount');
        $this->record->set('frequency'.$currentCount, $argument);
        $this->decision->any(DateStarted::class);
    }
}
