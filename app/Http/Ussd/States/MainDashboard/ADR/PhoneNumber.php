<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class PhoneNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter reporter phone number');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('reporterPhoneNumber', $argument);
        $this->decision->any(Institution::class);
    }
}
