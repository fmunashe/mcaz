<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\RelevantPastMedicalHistory;

use Sparors\Ussd\State;

class LabTestResult extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Past medical history lab test results');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('labTestResult', $argument);
        $this->decision->any(ActionTaken::class);
    }
}
