<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use App\Http\Ussd\States\MainDashboard\AEFI\DateAefiStarted;
use Sparors\Ussd\State;

class Other extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Specify if other');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('other', $argument);
        $this->decision->any(DateAefiStarted::class);
    }
}
