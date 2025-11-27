<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class Febrile extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Febrile or Afebrile');
        $this->menu->paginateListing([
            'Febrile',
            'Afebrile'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('febrile', 'Yes');
            $this->record->set('afebrile', 'No');
            $this->decision->any(Abscess::class);
        }
        if ($argument == '2') {
            $this->record->set('febrile', 'No');
            $this->record->set('afebrile', 'Yes');
            $this->decision->any(Abscess::class);
        }
        $this->decision->any(Febrile::class);
    }
}
