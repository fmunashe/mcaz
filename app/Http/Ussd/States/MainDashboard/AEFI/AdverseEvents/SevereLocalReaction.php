<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class SevereLocalReaction extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Severe local reaction');
        $this->menu->paginateListing([
            'Beyond nearest joint',
            'More than 3 days'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('severeLocalReaction', 'Yes');
            $this->record->set('beyondNearestJoint', 'Yes');
            $this->decision->any(Seizures::class);
        }
        if ($argument == '2') {
            $this->record->set('severeLocalReaction', 'Yes');
            $this->record->set('beyondNearestJoint', 'No');
            $this->decision->any(Seizures::class);
        }
        $this->decision->any(SevereLocalReaction::class);

    }
}
