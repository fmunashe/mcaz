<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use Sparors\Ussd\State;

class GuestComplaintDetails extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter details of the complaint');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestComplaintDetails', $argument);
        $this->decision->any(GuestLocationToBeInvestigated::class);
    }
}
