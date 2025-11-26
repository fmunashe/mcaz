<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class ReportAdr extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Identities of Reporter, Patient and Institute will remain confidential');
        $this->menu->line('Patient Initials');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
        }
        $this->record->set('patientName', $argument);
        $this->decision->any(Dob::class);

    }
}
