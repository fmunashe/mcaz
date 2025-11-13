<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use Sparors\Ussd\State;

class GuestLocationToBeInvestigated extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter location of premises to be investigated');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestLocationToBeInvestigated', $argument);
        $this->decision->any(GuestDescriptionOfPremisesBeingInvestigated::class);
    }
}
