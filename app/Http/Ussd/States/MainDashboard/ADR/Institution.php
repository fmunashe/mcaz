<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class Institution extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter institution name');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('institutionName', $argument);
        $this->decision->any(InstitutionAddress::class);
    }
}
