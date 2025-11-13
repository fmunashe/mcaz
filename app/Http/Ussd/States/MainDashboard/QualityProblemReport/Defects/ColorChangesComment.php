<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class ColorChangesComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Colour changes comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('colorChangesComment', $argument);
        $this->decision->any(FungalGrowth::class);
    }
}
