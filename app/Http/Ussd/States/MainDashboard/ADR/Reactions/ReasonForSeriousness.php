<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\Reactions;

use App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications\NumberOfMedicationsToCapture;
use App\Models\ADRSeriousReason;
use Sparors\Ussd\State;

class ReasonForSeriousness extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter reason for seriousness');
        $this->menu->paginateListing([
            'Death',
            'Life threatening',
            'Hospitalization or prolonged',
            'Disabling',
            'Congenital anomaly',
            'Other medically important condition',
        ], 1, 6, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2, 3, 4, 5, 6])) {
            $this->decision->any(self::class);
            return;
        }
        if ($argument == 1) {
            $reason = $this->getAdrReasonByName('Death');
            $this->record->set('reasonForSeriousness', $reason->id);
        }
        if ($argument == 2) {
            $reason = $this->getAdrReasonByName('Life-threatening');
            $this->record->set('reasonForSeriousness', $reason->id);
        }
        if ($argument == 3) {
            $reason = $this->getAdrReasonByName('Hospitalization/prolonged');
            $this->record->set('reasonForSeriousness', $reason->id);
        }
        if ($argument == 4) {
            $reason = $this->getAdrReasonByName('Disabling');
            $this->record->set('reasonForSeriousness', $reason->id);
        }
        if ($argument == 5) {
            $reason = $this->getAdrReasonByName('Congenital-anomaly');
            $this->record->set('reasonForSeriousness', $reason->id);
        }
        if ($argument == 6) {
            $reason = $this->getAdrReasonByName('Other medically important condition');
            $this->record->set('reasonForSeriousness', $reason->id);
        }
        $this->decision->any(NumberOfMedicationsToCapture::class);
    }

    private function getAdrReasonByName($name)
    {
        return ADRSeriousReason::where('reason', $name)->first();
    }
}
