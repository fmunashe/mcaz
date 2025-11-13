<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport\Defects;

use Sparors\Ussd\State;

class WrongPackagingComment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Wrong packaging comment');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('wrongPackagingComment', $argument);
        $this->decision->any(WrongStrength::class);
    }
}
