<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use Sparors\Ussd\State;

class GuestDirectionsToPremisesBeingInvestigated extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Directions to premises to be investigated');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestDirectionsToPremisesBeingInvestigated', $argument);
        $this->decision->any(GuestContactDetailsForThePersonToBeInvestigated::class);
    }
}
