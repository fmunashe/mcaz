<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\RelevantPastDrugTherapy;

use Sparors\Ussd\State;

class Frequency extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter frequency of drug therapy dose');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('drugTherapyCount');
        $this->record->set('drugTherapyFrequency'.$currentCount, $argument);
        $this->decision->any(DateStarted::class);
    }
}
