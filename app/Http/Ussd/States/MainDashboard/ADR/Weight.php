<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class Weight extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Patient Weight in kgs');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
        }
        $this->record->set('weight', $argument);
        $this->decision->any(Height::class);
    }
}
