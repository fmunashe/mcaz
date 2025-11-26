<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\MedicalHistory;

use App\Http\Ussd\States\MainDashboard\ADR\ReporterFullName;
use Sparors\Ussd\State;

class PreviousIllness extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Previous illness if any');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('adrPreviousIllness', $argument);
        $this->decision->any(ReporterFullName::class);
    }
}
