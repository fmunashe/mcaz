<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class IntendedUse extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Intended Use');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('intendedUse', $argument);
        $this->decision->any(TypeOfContainer::class);
    }
}
