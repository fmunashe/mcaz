<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class HospitalName extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Clinic or hospital name');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
        }
        $this->record->set('hospitalName', $argument);
        $this->decision->any(HospitalNumber::class);
    }
}
