<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use Sparors\Ussd\State;

class GuestComplaintTelephone extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter your telephone number or No to skip');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestComplaintTelephone', $argument);
        $this->decision->any(GuestComplaintEmail::class);
    }
}
