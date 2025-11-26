<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\MedicalHistory;

use App\Http\Ussd\States\MainDashboard\ADR\ReporterFullName;
use Sparors\Ussd\State;

class RelevantMedicalHistory extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Relevant medical history');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('adrRelevantMedicalHistory', $argument);
        $this->decision->any(PreviousIllness::class);
    }
}
