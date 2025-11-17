<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class Email extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter reporter email address');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('reporterEmail', $argument);
        $this->decision->any(PhoneNumber::class);
    }
}
