<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications;

use Sparors\Ussd\State;

class BrandName extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter brand name '.$this->record->get('medicationCount').' of current medication');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('medicationCount');
        $this->record->set('brandName'.$currentCount, $argument);
        $this->decision->any(BatchNumber::class);
    }
}
