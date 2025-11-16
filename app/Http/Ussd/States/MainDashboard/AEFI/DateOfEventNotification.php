<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class DateOfEventNotification extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Date patient notified event to health system');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('dateOfEventNotification', $argument);
        $this->decision->any(HealthFacilityName::class);
    }
}
