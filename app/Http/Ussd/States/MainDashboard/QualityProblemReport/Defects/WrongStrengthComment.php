<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class WrongStrengthComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Wrong strength comment');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('wrongStrengthComment', $argument);
        $this->decision->any(LackOfTherapeuticResponse::class);
    }
}
