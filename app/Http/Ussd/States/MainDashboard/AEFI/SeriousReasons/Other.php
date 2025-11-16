<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\SeriousReasons;

use App\Http\Ussd\States\MainDashboard\AEFI\Outcome\Outcome;
use Sparors\Ussd\State;

class Other extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Specify other important medical event');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('otherReason', $argument);
        $this->decision->any(Outcome::class);
    }
}
