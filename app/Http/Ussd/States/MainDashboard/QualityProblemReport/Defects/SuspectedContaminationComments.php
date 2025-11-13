<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class SuspectedContaminationComments extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Suspected contamination comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('suspectedContaminationComment', $argument);
        $this->decision->any(ParenteralSolutionLeaks::class);
    }
}
