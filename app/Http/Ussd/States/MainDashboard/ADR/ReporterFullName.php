<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class ReporterFullName extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter reporter full name');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('reporterFullName', $argument);
        $this->decision->any(Designation::class);
    }
}
