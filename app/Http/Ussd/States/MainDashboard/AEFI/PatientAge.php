<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class PatientAge extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Patient age');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('patientAge', $argument);
        $this->decision->any(AgeGroup::class);
    }
}
