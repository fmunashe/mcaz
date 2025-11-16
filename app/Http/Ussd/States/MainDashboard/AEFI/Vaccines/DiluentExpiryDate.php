<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Vaccines;

use Sparors\Ussd\State;

class DiluentExpiryDate extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Diluent expiry date');
    }

    protected function afterRendering(string $argument): void
    {
        $count = $this->record->get('vaccineCount');
        $this->record->set('diluentExpiryDate'.$count, $argument);
        $this->decision->any(DiluentTimeOfReconstitution::class);
    }
}
