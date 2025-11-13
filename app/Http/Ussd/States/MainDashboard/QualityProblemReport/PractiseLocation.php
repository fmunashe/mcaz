<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class PractiseLocation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Practice location');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('practiseLocation', $argument);
        $this->decision->any(PractiseAddress::class);
    }
}
