<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class TitleOfReporter extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Title of reporter');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('titleOfReporter', $argument);
        $this->decision->any(PractiseLocation::class);
    }
}
