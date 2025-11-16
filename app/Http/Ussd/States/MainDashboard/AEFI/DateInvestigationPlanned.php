<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class DateInvestigationPlanned extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Date investigation planned');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('dateInvestigationPlanned', $argument);
        $this->decision->any(Comments::class);
    }
}
