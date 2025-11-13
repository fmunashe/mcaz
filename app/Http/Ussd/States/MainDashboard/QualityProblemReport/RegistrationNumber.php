<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class RegistrationNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Registration number');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('registrationNumber', $argument);
        $this->decision->any(BatchNumber::class);
    }
}
