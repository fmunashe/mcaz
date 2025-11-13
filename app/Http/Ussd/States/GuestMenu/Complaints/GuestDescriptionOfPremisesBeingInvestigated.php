<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use Sparors\Ussd\State;

class GuestDescriptionOfPremisesBeingInvestigated extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Description of premises to be investigated');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestDescriptionOfPremisesBeingInvestigated', $argument);
        $this->decision->any(GuestDirectionsToPremisesBeingInvestigated::class);
    }
}
