<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class VaccineName extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Vaccine name');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('vaccineName'.$count, $argument);
        $this->decision->any(BrandName::class);
    }
}
