<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class Febrile extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Febrile');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('febrile', 'Yes');
            $this->decision->any(Afebrile::class);
        }
        if ($argument == '2') {
            $this->record->set('febrile', 'No');
            $this->decision->any(Afebrile::class);
        }
        $this->decision->any(Febrile::class);
    }
}
