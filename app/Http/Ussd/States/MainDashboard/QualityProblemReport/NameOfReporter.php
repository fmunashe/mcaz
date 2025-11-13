<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class NameOfReporter extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Name of reporter');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('nameOfReporter', $argument);
        $this->decision->any(TitleOfReporter::class);
    }
}
