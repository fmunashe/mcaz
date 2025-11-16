<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class TimeOfVaccination extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Time of vaccination');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('timeOfVaccination'.$count, $argument);
        $this->decision->any(Dose::class);
    }
}
