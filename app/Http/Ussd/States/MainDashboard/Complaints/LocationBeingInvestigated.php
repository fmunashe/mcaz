<?php

namespace App\Http\Ussd\States\MainDashboard\Complaints;

use Sparors\Ussd\State;

class LocationBeingInvestigated extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Exact location of premises to be investigated');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('locationBeingInvestigated', $argument);
        $this->decision->any(DescriptionOfPremisesBeingInvestigated::class);
    }
}
