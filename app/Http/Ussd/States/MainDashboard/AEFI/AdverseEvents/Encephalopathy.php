<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class Encephalopathy extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Encephalopathy');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('encephalopathy', 'Yes');
            $this->decision->any(ToxicShockSyndrome::class);
        }
        if ($argument == '2') {
            $this->record->set('encephalopathy', 'No');
            $this->decision->any(ToxicShockSyndrome::class);
        }
        $this->decision->any(Encephalopathy::class);
    }
}
