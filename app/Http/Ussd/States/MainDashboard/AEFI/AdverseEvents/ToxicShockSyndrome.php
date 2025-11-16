<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class ToxicShockSyndrome extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Toxic shock syndrome');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('toxicShockSyndrome', 'Yes');
            $this->decision->any(Thrombocytopenia::class);
        }
        if ($argument == '2') {
            $this->record->set('toxicShockSyndrome', 'No');
            $this->decision->any(Thrombocytopenia::class);
        }
        $this->decision->any(ToxicShockSyndrome::class);
    }
}
