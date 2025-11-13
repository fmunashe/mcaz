<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class NameOfManufacturer extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Name of manufacturer');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('nameOfManufacturer', $argument);
        $this->decision->any(AddressOfManufacturer::class);
    }
}
