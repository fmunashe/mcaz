<?php

namespace App\Http\Ussd\States\MainDashboard\Complaints;

use Sparors\Ussd\State;

class DirectionsToPremisesBeingInvestigated extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Directions to premises to be investigated');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('directionsToPremisesBeingInvestigated', $argument);
        $this->decision->any(ContactDetailsForThePersonToBeInvestigated::class);
    }
}
