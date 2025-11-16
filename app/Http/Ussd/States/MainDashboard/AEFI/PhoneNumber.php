<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class PhoneNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Reporter phone number');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('phoneNumber', $argument);
        $this->decision->any(EmailAddress::class);
    }
}
