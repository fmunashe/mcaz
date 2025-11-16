<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use App\Http\Ussd\States\MainDashboard\AEFI\RelevantPastMedicalHistory\LabTestResult;
use Sparors\Ussd\State;

class AutopsyDone extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Autopsy done');
        $this->menu->paginateListing([
            'Yes',
            'No',
            'Unknown'
        ], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if ($argument == '1') {
            $this->record->set('autopsyDone', 'Yes');
            $this->decision->any(LabTestResult::class);
        }
        if ($argument == '2') {
            $this->record->set('autopsyDone', 'No');
            $this->decision->any(LabTestResult::class);
        }
        if ($argument == '3') {
            $this->record->set('autopsyDone', 'Unknown');
            $this->decision->any(LabTestResult::class);
        }
        $this->decision->any(AutopsyDone::class);
    }
}
