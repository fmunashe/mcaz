<?php

namespace App\Http\Ussd\States\MainDashboard\Complaints;

use Sparors\Ussd\State;

class DescriptionOfPremisesBeingInvestigated extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Description of location being investigated');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('descriptionOfPremisesBeingInvestigated', $argument);
        $this->decision->any(DirectionsToPremisesBeingInvestigated::class);
    }
}
