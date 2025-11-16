<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class DateOfDeath extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Date of death');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('dateOfDeath', $argument);
        $this->decision->any(AutopsyDone::class);
    }
}
