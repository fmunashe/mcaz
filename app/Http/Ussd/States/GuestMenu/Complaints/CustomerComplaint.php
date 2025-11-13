<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use Sparors\Ussd\State;

class CustomerComplaint extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter your name or No to skip')
            ->lineBreak();
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestComplaintName', $argument);
        $this->decision->any(GuestComplaintAddress::class);
    }
}
