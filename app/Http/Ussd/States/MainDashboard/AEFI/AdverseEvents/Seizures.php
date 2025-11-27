<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class Seizures extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Seizures');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('seizures', 'Yes');
            $this->decision->any(Febrile::class);
        }
        if ($argument == '2') {
            $this->record->set('seizures', 'No');
            $this->decision->any(Abscess::class);
        }
        $this->decision->any(Seizures::class);
    }
}
