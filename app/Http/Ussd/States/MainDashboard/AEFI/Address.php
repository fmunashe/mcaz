<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class Address extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Address');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('address', $argument);
        $this->decision->any(PhoneNumber::class);
    }
}
