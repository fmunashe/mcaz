<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class ExpiryDate extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Expiry date');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('expiryDate', $argument);
        $this->decision->any(NameOfManufacturer::class);
    }
}
