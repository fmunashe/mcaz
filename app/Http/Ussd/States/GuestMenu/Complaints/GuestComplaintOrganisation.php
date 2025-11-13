<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use Sparors\Ussd\State;

class GuestComplaintOrganisation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter your organisation or No to skip');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestComplaintOrganisationName', $argument);
        $this->decision->any(GuestComplaintDetails::class);
    }
}
