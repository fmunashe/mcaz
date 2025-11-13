<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class UnusualOdourComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Unusual odour comments');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('unusualOdourComment', $argument);
        $this->decision->any(ColorChanges::class);
    }
}
