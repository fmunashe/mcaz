<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class PatientFullAddress extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Patient address');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('patientAddress', $argument);
        $this->decision->any(Telephone::class);
    }
}
