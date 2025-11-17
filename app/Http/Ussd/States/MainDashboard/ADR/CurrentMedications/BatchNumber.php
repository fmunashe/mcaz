<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications;

use Sparors\Ussd\State;

class BatchNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter batch number '.$this->record->get('medicationCount').' of current medication');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('medicationCount');
        $this->record->set('batchNumber'.$currentCount, $argument);
        $this->decision->any(Dose::class);
    }
}
