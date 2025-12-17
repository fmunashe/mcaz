<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\RelevantPastDrugTherapy;

use App\Http\Ussd\States\MainDashboard\ADR\MedicalHistory\LabTestResults;
use App\Http\Ussd\States\MainDashboard\ADR\MedicalHistory\RelevantMedicalHistory;
use Sparors\Ussd\State;

class NumberOfDrugTherapyToCapture extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter number of past drug therapy to capture');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('numberOfDrugTherapyToCapture', $argument);
        $this->record->set('drugTherapyCount', 1);
        if ($argument == 0) {
            $this->decision->any(RelevantMedicalHistory::class);
        }
        $this->decision->any(BrandName::class);
    }
}
