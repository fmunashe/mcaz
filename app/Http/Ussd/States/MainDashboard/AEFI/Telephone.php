<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class Telephone extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Patient telephone number');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('patientTelephone', $argument);
        $this->decision->any(Gender::class);
    }
}
