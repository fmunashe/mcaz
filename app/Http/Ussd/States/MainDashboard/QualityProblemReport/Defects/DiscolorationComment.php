<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class DiscolorationComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Discoloration comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('discolorationComment', $argument);
        $this->decision->any(WrongLabel::class);
    }
}
