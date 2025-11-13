<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class LackOfTherapeuticResponseComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Lack of therapeutic response comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('lackOfTherapeuticResponseComment', $argument);
        $this->decision->any(Other::class);
    }
}
