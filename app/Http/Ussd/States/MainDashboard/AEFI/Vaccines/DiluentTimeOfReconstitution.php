<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use App\Http\Ussd\Actions\MainDashboard\AEFI\Vaccines\CheckVaccineCount;
use Sparors\Ussd\State;

class DiluentTimeOfReconstitution extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Diluent time of reconstitution');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('diluentTimeOfReconstitution'.$count, $argument);
        $this->decision->any(CheckVaccineCount::class);
    }
}
