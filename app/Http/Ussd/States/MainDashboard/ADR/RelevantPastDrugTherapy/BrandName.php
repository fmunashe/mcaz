<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\RelevantPastDrugTherapy;

use Sparors\Ussd\State;

class BrandName extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter brand name of drug therapy');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('drugTherapyCount');
        $this->record->set('drugTherapyBrandName'.$currentCount, $argument);
        $this->decision->any(BatchNumber::class);
    }
}
