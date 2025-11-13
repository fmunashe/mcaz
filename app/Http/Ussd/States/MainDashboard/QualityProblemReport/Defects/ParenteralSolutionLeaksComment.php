<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class ParenteralSolutionLeaksComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Parenteral solution leaks comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('parenteralSolutionLeaksComment', $argument);
        $this->decision->any(ParticulateMatter::class);
    }
}
