<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications;

use Sparors\Ussd\State;

class Dose extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter dose '.$this->record->get('medicationCount').' of current medication');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('medicationCount');
        $this->record->set('dose'.$currentCount, $argument);
        $this->decision->any(Frequency::class);
    }
}
