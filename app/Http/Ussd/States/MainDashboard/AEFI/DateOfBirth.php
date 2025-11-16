<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class DateOfBirth extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Date of birth format dd/mm/yyyy');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('dateOfBirth', $argument);
        $this->decision->any(PatientAge::class);
    }
}
