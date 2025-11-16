<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class DateAefiStarted extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Date AEFI started');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('dateAefiStarted', $argument);
        $this->decision->any(Serious::class);
    }
}
