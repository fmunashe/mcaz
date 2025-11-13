<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use Sparors\Ussd\State;

class GuestComplaintEmail extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter your email address or No to skip');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestComplaintEmail', $argument);
        $this->decision->any(GuestComplaintOrganisation::class);
    }
}
