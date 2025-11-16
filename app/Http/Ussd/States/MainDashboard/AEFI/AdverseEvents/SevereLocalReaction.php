<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class SevereLocalReaction extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Severe local reaction');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('severeLocalReaction', 'Yes');
            $this->decision->any(Seizures::class);
        }
        if ($argument == '2') {
            $this->record->set('severeLocalReaction', 'No');
            $this->decision->any(Seizures::class);
        }
        $this->decision->any(SevereLocalReaction::class);

    }
}
