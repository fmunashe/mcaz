<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class PractiseAddress extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Practice address');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('practiseAddress', $argument);
        $this->decision->any(PhoneNumber::class);
    }
}
