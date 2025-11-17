<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications;

use Sparors\Ussd\State;

class NumberOfMedicationsToCapture extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter number of current medications to capture');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('numberOfMedicationsToCapture', $argument);
        $this->record->set('medicationCount', 1);
        $this->decision->any(BrandName::class);
    }
}
