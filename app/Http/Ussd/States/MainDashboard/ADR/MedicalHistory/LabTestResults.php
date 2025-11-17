<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\MedicalHistory;

use Sparors\Ussd\State;

class LabTestResults extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Relevant medical history lab test results');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('AdrLabTestResults', $argument);
        $this->decision->any(ActionTaken::class);
    }
}
