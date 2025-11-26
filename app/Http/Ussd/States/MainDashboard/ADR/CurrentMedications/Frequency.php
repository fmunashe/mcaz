<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications;

use Sparors\Ussd\State;

class Frequency extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter dose frequency '.$this->record->get('medicationCount').' e.g 2 tablets 50mg, 3 times a day');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('medicationCount');
        $this->record->set('frequency'.$currentCount, $argument);
        $this->decision->any(MethodOfAdministration::class);
    }
}
