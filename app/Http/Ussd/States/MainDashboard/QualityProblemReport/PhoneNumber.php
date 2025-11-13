<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class PhoneNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Phone number');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('phoneNumber', $argument);
        $this->decision->any(DateProblemObserved::class);
    }
}
