<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class Afebrile extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Afebrile');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('afebrile', 'Yes');
            $this->decision->any(Other::class);
        }
        if ($argument == '2') {
            $this->record->set('afebrile', 'No');
            $this->decision->any(Other::class);
        }
        $this->decision->any(Afebrile::class);
    }
}
