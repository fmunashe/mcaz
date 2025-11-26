<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\Reactions;

use App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications\NumberOfMedicationsToCapture;
use App\Models\ADRSeriousReason;
use Sparors\Ussd\State;

class AdrSerious extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Is the adverse reaction serious');
        $this->menu->paginateListing([
            'No',
            'Yes - Resulted in death',
            'Yes - Life threatening',
            'Yes - Hospitalization/prolonged',
            'Yes - Disabling',
            'Yes - Congenital anomaly',
            'Yes - Other medically important condition'
        ], 1, 8, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2, 3, 4, 5, 6, 7])) {
            $this->decision->any(self::class);
            return;
        }
        if ($argument == 1) {
            $this->record->set('adrSerious', 'No');
            $this->decision->any(NumberOfMedicationsToCapture::class);
        }

        if ($argument == 2) {
            $reason = $this->getAdrReasonByName('Death');
            $this->record->set('reasonForSeriousness', $reason->id);
            $this->decision->any(NumberOfMedicationsToCapture::class);
        }
        if ($argument == 3) {
            $reason = $this->getAdrReasonByName('Life-threatening');
            $this->record->set('reasonForSeriousness', $reason->id);
            $this->decision->any(NumberOfMedicationsToCapture::class);
        }
        if ($argument == 4) {
            $reason = $this->getAdrReasonByName('Hospitalization/prolonged');
            $this->record->set('reasonForSeriousness', $reason->id);
            $this->decision->any(NumberOfMedicationsToCapture::class);
        }
        if ($argument == 5) {
            $reason = $this->getAdrReasonByName('Disabling');
            $this->record->set('reasonForSeriousness', $reason->id);
            $this->decision->any(NumberOfMedicationsToCapture::class);
        }
        if ($argument == 6) {
            $reason = $this->getAdrReasonByName('Congenital-anomaly');
            $this->record->set('reasonForSeriousness', $reason->id);
            $this->decision->any(NumberOfMedicationsToCapture::class);
        }
        if ($argument == 7) {
            $reason = $this->getAdrReasonByName('Other medically important condition');
            $this->record->set('reasonForSeriousness', $reason->id);
            $this->decision->any(NumberOfMedicationsToCapture::class);
        }
        $this->decision->any(self::class);
    }

    private function getAdrReasonByName($name)
    {
        return ADRSeriousReason::where('reason', $name)->first();
    }
}
