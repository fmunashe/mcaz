<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class Height extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Patient Height in meters');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
        }
        $this->record->set('height', $argument);
        $this->decision->any(Gender::class);
    }
}
