<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use Sparors\Ussd\State;

class GuestComplaintAddress extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter your address or No to skip');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestComplaintAddress', $argument);
            $this->decision->any(GuestComplaintTelephone::class);
    }
}
