<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class Age extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Patient age');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
        }
        $this->record->set('age', $argument);
        $this->decision->any(HospitalName::class);
    }
}
