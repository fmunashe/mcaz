<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class Manufacturer extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Manufacturer');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('manufacturer'.$count, $argument);
        $this->decision->any(DateOfVaccination::class);
    }
}
