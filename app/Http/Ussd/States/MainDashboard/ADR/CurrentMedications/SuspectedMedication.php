<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications;

use App\Http\Ussd\Actions\MainDashboard\ADR\CurrentMedications\CheckCurrentMedicationCount;
use Sparors\Ussd\State;

class SuspectedMedication extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Is this a suspected medication '.$this->record->get('medicationCount'));
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2])) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('medicationCount');

        if ($argument == 1) {
            $this->record->set('suspectedMedication' . $currentCount, 'Yes');
        } else {
            $this->record->set('suspectedMedication' . $currentCount, 'No');
        }

        $this->decision->any(CheckCurrentMedicationCount::class);
    }
}
