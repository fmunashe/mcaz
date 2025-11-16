<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class DateOfVaccination extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Date of vaccination');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('dateOfVaccination'.$count, $argument);
        $this->decision->any(TimeOfVaccination::class);
    }

}
