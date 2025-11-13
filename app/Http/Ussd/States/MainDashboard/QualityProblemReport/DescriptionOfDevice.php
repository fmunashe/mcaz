<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class DescriptionOfDevice extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Description of the Device');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('descriptionOfDevice', $argument);
        $this->decision->any(IntendedUse::class);
    }
}
