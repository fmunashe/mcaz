<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use Sparors\Ussd\State;

class AddressOfManufacturer extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Address of manufacturer');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('addressOfManufacturer', $argument);
        $this->decision->any(NameOfReporter::class);
    }
}
