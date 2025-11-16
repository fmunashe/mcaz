<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class Designation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Designation and department');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('designation', $argument);
        $this->decision->any(Address::class);
    }
}
