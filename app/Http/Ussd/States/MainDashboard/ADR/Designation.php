<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class Designation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter reporter designation');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('reporterDesignation', $argument);
        $this->decision->any(Email::class);
    }
}
