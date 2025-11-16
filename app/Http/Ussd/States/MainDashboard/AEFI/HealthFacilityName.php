<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class HealthFacilityName extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Health facility or vaccination centre name');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('healthFacilityName', $argument);
        $this->decision->any(NumberOfVaccinesToCapture::class);
    }
}
