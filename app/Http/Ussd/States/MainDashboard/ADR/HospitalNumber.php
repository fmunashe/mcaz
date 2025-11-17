<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class HospitalNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Clinic or hospital number');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
        }
        $this->record->set('hospitalNumber', $argument);
        $this->decision->any(VctNumber::class);
    }
}
