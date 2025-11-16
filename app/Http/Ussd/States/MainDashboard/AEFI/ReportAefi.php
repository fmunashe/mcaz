<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class ReportAefi extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Patient full name');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('patientFullName', $argument);
        $this->decision->any(PatientFullAddress::class);
    }
}
