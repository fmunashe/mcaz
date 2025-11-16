<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Sparors\Ussd\State;

class ReporterName extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Reporter name');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('reporterName', $argument);
        $this->decision->any(Institution::class);
    }
}
