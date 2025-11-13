<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class TypeOfContainer extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Type of Container');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('typeOfContainer', $argument);
        $this->decision->any(RegistrationNumber::class);
    }
}
