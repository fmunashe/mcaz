<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\RelevantPastDrugTherapy;

use Sparors\Ussd\State;

class BatchNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter batch number of drug therapy');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('drugTherapyCount');
        $this->record->set('drugTherapyBatchNumber'.$currentCount, $argument);
        $this->decision->any(Dose::class);
    }
}
