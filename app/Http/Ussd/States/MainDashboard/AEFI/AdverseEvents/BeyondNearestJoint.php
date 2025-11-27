<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class BeyondNearestJoint extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Beyond nearest joint');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('beyondNearestJoint', 'Yes');

            $this->decision->any(Other::class);
        }
        if ($argument == '2') {
            $this->record->set('beyondNearestJoint', 'No');
            $this->decision->any(Other::class);
        }
        $this->decision->any(BeyondNearestJoint::class);
    }
}
